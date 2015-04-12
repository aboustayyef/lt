<?php namespace LebaneseTweets\Twitter;

	/**
	*  Gets tweets from twitter
	*
	*/

	class TweetsGetter
	{
		
		private $tweet;
		private $twitterClient;

		function __construct()
		{
			$this->twitterClient = new \Twitter(getenv('TWITTER_CONSUMER_KEY'), getenv('TWITTER_CONSUMER_SECRET'), getenv('TWITTER_ACCESS_TOKEN'),getenv('TWITTER_ACCESS_TOKEN_SECRET'));
		}

		public function getFromUsername($username='beirutspring', $howmany = 5)
		{
			try {
				$rawTweets = $this->twitterClient->request('statuses/user_timeline','GET',['screen_name'=>$username, 'count'=>$howmany]);
			} catch (Exception $e) {
				return "Exception: $e";
			}
			
			return $rawTweets;			
		}

		public function getNameFromHandle($username='beirutspring'){
			try {
				$user = $this->twitterClient->request('users/show','GET',['screen_name'=>$username]);
			} catch (Exception $e) {
				return "Exception: $e";
			}
			return $user->name;
		}

		public function getTweetDetails($tweetId=null){
			try {
				$tweetDetails = $this->twitterClient->request('statuses/lookup', 'GET', ['id' => $tweetId]);
			} catch (Exception $e) {
				return "Exception: $e";			
			}
			return $tweetDetails;
		}

		public function status(){
			try {
				$status = $this->twitterClient->request('application/rate_limit_status', 'GET');
				$status = $status->resources->statuses->{'/statuses/user_timeline'}->remaining;
			} catch (Exception $e) {
				return "Exception: $e";
			}
			
			return $status;
		}

	}

?>

