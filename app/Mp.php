<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use \LebaneseTweets\Utilities\RefreshListOfMps;
use \LebaneseTweets\Twitter\TweetsGetter;

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
	
	public function getLatestTweets($howmany = 5){
		$tweets = (new TweetsGetter)->getFromUsername($this->twitterHandle, $howmany);
		return $tweets;
	}

	public function tweets(){
		return $this->hasMany('\LebaneseTweets\Tweet');
	}

}


?>