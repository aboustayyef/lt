<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use LebaneseTweets\Utilities\TweetContentParser;
use \Carbon\Carbon;

class Tweet extends Model {

	protected $guarded = array('id', 'created_at', 'updated_at');

	public function mp(){
		return $this->belongsTo('\LebaneseTweets\Mp');
	}

	/**
	 * Store a raw twitter object into tweets table
	 * 
	 * @param  $tweet Raw Twitter object extracted from the Twitter client
	 * @param  $category, one of ['mp','blogger', 'journalist']
	 * @param  $category_id, the id of the category (from model)
	 * @return void
	 */
	public function store($tweet, $category ='mps', $category_id = null){

		switch ($category) {
			case 'mps':
				$this->mp_id = $category_id;
				break;
			case 'journalists':
				$this->journalist_id = $category_id;
				break;
			case 'bloggers':
				$this->blogger_id = $category_id;
				break;
			default:
				return false; // only one of the authorised kinds should be included
				break;
		}


		// manage Raw Twitter Object
		$retweeted = isset($tweet->retweeted_status) ? 1:0 ;
		$canonicalTweet = $retweeted? $tweet->retweeted_status : $tweet;
		$canonicalUser = $canonicalTweet->user;

		// store it
		$this->twitter_id = $canonicalTweet->id ;
		$this->content = (new TweetContentParser($canonicalTweet))->parse() ;
		$this->is_retweet = $retweeted ;
		$this->username = $canonicalUser->screen_name; ;
		$this->user_image = $canonicalUser->profile_image_url;
		$this->tweet_date = (new Carbon)->parse($tweet->created_at);
		$this->media = isset($tweet->media)? $tweet->media : null ;
		$this->favorites = $canonicalTweet->favorite_count; ;
		$this->retweets	= $canonicalTweet->retweet_count;

		// save it
		$this->save();

		// return status;
		$status = 'added tweet: http://twitter.com/'.$this->username.'/status/'.$this->twitter_id . ' F:'.$this->favorites.' R: '.$this->retweets;
		return $status;
	}

}
