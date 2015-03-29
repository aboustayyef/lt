<?php namespace LebaneseTweets\Twitter;

	/**
	*  Gets tweets from twitter
	*
	*/

	class TweetsGetter
	{
		
		private $tweet;

		function __construct()
		{
		}

		public function getFromUsername($username='beirutspring', $howmany = 5)
		{

			$twitter = new \Twitter(getenv('TWITTER_CONSUMER_KEY'), getenv('TWITTER_CONSUMER_SECRET'), getenv('TWITTER_ACCESS_TOKEN'),getenv('TWITTER_ACCESS_TOKEN_SECRET'));
			$rawTweets = $twitter->request('statuses/user_timeline','GET',['screen_name'=>$username, 'count'=>$howmany]);
			return $rawTweets;			
		}

	}

?>

