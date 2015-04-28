<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use \LebaneseTweets\Utilities\TweetContentParser;
use \Carbon\Carbon;

class Tweet extends Model {

	protected $guarded = array('id', 'created_at', 'updated_at');


	public function tweep(){
		return $this->belongsTo('\LebaneseTweets\Tweep');
	}

	public function link(){
		return $this->belongsTo('\LebaneseTweets\Link');
	}

	// This function build the query for tweets on several filter levels.

	public function makeQuery($group = null, $from = 0, $to = 20, $request=null){
		
		$subgroupStructure = [
			'politicians' => ['district', 'party', 'sect'],
			'journalists' => ['outfit', 'medium'] // 'station/newspaper' , 'print/tv/radio/online'
		];

			$tweetsQueryBuilder = $this->orderBy('tweet_date','desc')->where('is_reply',0);

		if ($group) {
			
			$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweep_group', $group);
		
			// check for subgroup-speficific filters
			
			$subgroups = $subgroupStructure[$group];
			foreach ($subgroups as $key => $subgroup) {
				if ($request->has($subgroup)){
					$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweep_subgroups','LIKE', '%' . $request->get($subgroup) . '%');
				}
			}
		}


		// check for show Images
			if (($request->has('show_images_only')) && ($request->get('show_images_only') == 'yes')) {
				$tweetsQueryBuilder = $tweetsQueryBuilder->where('media_height','>',0);
			}

		$tweets = $tweetsQueryBuilder->skip($from)->take($to - $from)->get();
		return $tweets;

	}

	/**
	 * Store a raw twitter object into tweets table
	 * 
	 * @param  $tweet Raw Twitter object extracted from the Twitter client
	 * @param  $category, one of ['mp','blogger', 'journalist']
	 * @param  $category_id, the id of the category (from model)
	 * @return void
	 */
	public function store($tweet, $tweep_id = null){
		// manage Raw Twitter Object
		$retweeted = isset($tweet->retweeted_status) ? 1:0 ;
		$isreply = isset($tweet->in_reply_to_status_id) ? 1:0 ;
		$canonicalTweet = $retweeted? $tweet->retweeted_status : $tweet;
		$canonicalUser = $canonicalTweet->user;

		// store it
		$this->twitter_id = $canonicalTweet->id ;
		$contentParser = (new TweetContentParser($canonicalTweet))->parse();
		$this->content =  $contentParser[0];
		$lastUrl = $contentParser[1];
		$this->is_retweet = $retweeted ;
		$this->is_reply = $isreply;
		$this->username = $canonicalUser->screen_name; ;
		$this->user_image = $canonicalUser->profile_image_url;
		$this->tweet_date = (new Carbon)->parse($tweet->created_at);
		$this->tweep_id = $tweep_id;

		// media		
		if (isset($canonicalTweet->entities->media[0]->media_url)){	
			
			try{
				$media = $canonicalTweet->entities->media[0]->media_url;
				$dimensions = @getimagesize($media);
				$this->media = $media;
				$this->media_width = $dimensions[0];
				$this->media_height = $dimensions[1];
			} catch (Exception $e) {
				echo "could not save media\n";
			}
			
		} else {
			#Check if there's an instagram link
			echo "Looking for instagram image \n";
			preg_match('#(instagram\.com/[\w-/]+)#', $this->content, $result);
			
			if (count($result) > 1) {
				$instagramPage = "https://".$result[1];
				echo "We found and instagram image at $instagramPage \n";

				$instagramScraper = new \LebaneseTweets\Utilities\InstagramScraper($instagramPage);
				if ($instagramScraper) {
					if ($instagramImage = $instagramScraper->image()) {
						echo "The Instagram Image is at $instagramImage\n";
						$imageName = md5($instagramImage) . '.jpg';
						$directory = public_path() . '/img/cache/';
						$destination = $directory . $imageName;
						echo "Destination: $destination \n";
						$imagick = new \iMagick($instagramImage);
						$imagick->thumbnailImage(400,0);
						$imagick->writeImage($destination);

						$this->media = 'img/cache/' . $imageName ;
						$this->media_width = 400;
						$this->media_height = 400;
					}
				}
			// if no instagram, look for link
			} elseif($lastUrl){

				// check if link already exists
				if (\LebaneseTweets\Link::where('url',$lastUrl)->count() > 0 ) {
					$link = \LebaneseTweets\Link::where('url',$lastUrl)->get()->first();
				} else {
					$link = (new \LebaneseTweets\Link);
					$link->build($lastUrl);	
				}
				$this->link_id = $link->id;
			}
		}

	
		// popularity
		
		$this->favorites = $canonicalTweet->favorite_count; ;
		$this->retweets	= $canonicalTweet->retweet_count;
		$this->popularity_score = $this->favorites + ($this->retweets * 2);


		// Tweep details
		$this->tweep_public_name = $this->tweep->public_name;
		$this->tweep_twitterHandle = $this->tweep->twitterHandle;
		$this->tweep_subgroups = $this->tweep->subgroups;
		$this->tweep_group = $this->tweep->group;

		// save it
		$this->save();

		// return status;
		$status = 'added tweet: http://twitter.com/'.$this->username.'/status/'.$this->twitter_id . ' F:'.$this->favorites.' R: '.$this->retweets;
		return $status;
	}



	public function top($group=null, $hours=12, $howmany=5){
		
		$tweetsQueryBuilder = $this;
		
		// narrow by group
		if ($group) {
			$tweetsQueryBuilder = $this->where('tweep_group', $group);
		}

		// remove retweets
		$tweetsQueryBuilder = $tweetsQueryBuilder->where('is_retweet', 0);

		// scope by time
		$now = new \Carbon\Carbon;
		$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweet_date','>', $now->subHours($hours));

		$tweets = $tweetsQueryBuilder->orderBy('popularity_score', 'desc')->take($howmany)->get();
		return $tweets;
	}

}
