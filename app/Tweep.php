<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use \Exception;
class Tweep extends Model {

protected $guarded = array('id', 'created_at', 'updated_at');

	public function getLatestTweets($twitterClient, $howmany = 5){
		$tweets = $twitterClient->getFromUsername($this->twitterHandle, $howmany);
		return $tweets;
	}

	public function tweets(){
		return $this->hasMany('\LebaneseTweets\Tweet');
	}

}
