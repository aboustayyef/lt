<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use \LebaneseTweets\Utilities\RefreshListOfMps;
use \LebaneseTweets\Utilities\TweetsFromTwitter;

class Mp extends Model {

	protected $guarded = array('id', 'created_at', 'updated_at');


	/**
	 * Refreshes the List of Mps in the database using the api
	 */

	public function refreshList(){
		(new RefreshListOfMps)->refresh();
	}


	/**
	 * Gets tweets from Twitter and converts them to a simplified array of objects
	 * @param  integer $howmany 
	 * @return array           
	 */
	
	public function getLatestTweetsFromTwitter($howmany = 5){
		$rawTweets = (new TweetsFromTwitter)->getFromUsername($this->twitterHandle, $howmany);
		return $rawTweets;
	}

	public function tweets(){
		return $this->hasMany('\LebaneseTweets\Tweet');
	}

}


?>