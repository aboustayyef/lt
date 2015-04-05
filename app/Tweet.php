<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use LebaneseTweets\Utilities\TweetContentParser;
use \Carbon\Carbon;

class Tweet extends Model {

	protected $guarded = array('id', 'created_at', 'updated_at');

	public function tweep(){
		return $this->belongsTo('\LebaneseTweets\Tweep');
	}


	// This function build the query for tweets on several filter levels.

	public static function query($group = null, $from = 0, $to = 20, $request=null){
		
		$subgroupStructure = [
			'politicians' => ['district', 'party', 'sect'],
			'bloggers' => ['tag']
		];

		$tweetsQueryBuilder = \DB::table('tweets')
			->Join('tweeps','tweets.tweep_id','=', 'tweeps.id')
			->orderBy('tweets.tweet_date','desc')
			->select(	'tweets.id as tweet_id',
						'tweets.twitter_id as twitter_id',
						'tweets.content as tweet_content',
						'tweets.is_retweet as tweet_is_retweet',
						'tweets.user_image as tweep_user_image',
						'tweets.tweet_date as tweet_date',
						'tweets.created_at as tweet_created_at',
						'tweets.media as tweet_media',
						'tweets.favorites as tweet_favorites',
						'tweets.retweets as tweet_retweets',
						'tweets.popularity_score as tweet_popularity_score',
						'tweets.media_height as tweet_media_height',
						'tweets.media_width as tweet_media_width',
						'tweeps.public_name as tweep_public_name',
						'tweeps.twitterHandle as tweep_twitterHandle',
						'tweets.username as tweet_twitterHandle',
						'tweeps.subgroups as tweep_subgroups',
						'tweets.is_reply as tweet_is_reply'
		);

		// Begin the filtering based on request parameters

		if ($group) {
			
			$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweeps.group', $group);
		
			// check for subgroup-speficific filters
			
			$subgroups = $subgroupStructure[$group];
			foreach ($subgroups as $key => $subgroup) {
				if ($request->has($subgroup)){
					$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweeps.subgroups','LIKE', '%' . $request->get($subgroup) . '%');
				}
			}
		}

		// check for retweets
			if (($request->has('hide_retweets')) && ($request->get('hide_retweets') == 'yes')) {
				$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweets.is_retweet',0);
			}
		
		// check for replies		
			if (($request->has('hide_replies')) && ($request->get('hide_replies') == 'yes')) {
				$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweets.is_reply',0);
			}

		// check for show Images
			if (($request->has('show_images_only')) && ($request->get('show_images_only') == 'yes')) {
				$tweetsQueryBuilder = $tweetsQueryBuilder->where('tweets.media_height','>',0);
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
		$this->content = (new TweetContentParser($canonicalTweet))->parse() ;
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
			
			
		}
		
		// popularity
		
		$this->favorites = $canonicalTweet->favorite_count; ;
		$this->retweets	= $canonicalTweet->retweet_count;
		$this->popularity_score = $this->favorites + ($this->retweets * 2);

		// save it
		$this->save();

		// return status;
		$status = 'added tweet: http://twitter.com/'.$this->username.'/status/'.$this->twitter_id . ' F:'.$this->favorites.' R: '.$this->retweets;
		return $status;
	}

}
