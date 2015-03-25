<?php namespace LebaneseTweets\Utilities;

	/**
	*  Gets and handles tweets from twitter
	*
	*  This class has three methods: 
	*  One gets the raw tweets from a username
	*  One converts raw tweets into structured objects
	*  One combines both into a wrapper
	*/

	class TweetsFromTwitter
	{
		
		private $tweet;

		function __construct()
		{
		}

		public function getFromUsername($username='beirutspring', $howmany = 5){
			
			// get the raw tweets
			$rawTweets = $this->getRawFromUsername($username, $howmany);
			
			// convert them to simple structured tweets
			$structuredTweets = $this->structureTweets($rawTweets);
			
			return $structuredTweets;
		}


		public function getRawFromUsername($username='beirutspring', $howmany = 5)
		{

			$twitter = new \Twitter(getenv('TWITTER_CONSUMER_KEY'), getenv('TWITTER_CONSUMER_SECRET'), getenv('TWITTER_ACCESS_TOKEN'),getenv('TWITTER_ACCESS_TOKEN_SECRET'));
			$rawTweets = $twitter->request('statuses/user_timeline','GET',['screen_name'=>$username, 'count'=>$howmany]);
			return $rawTweets;			
		}


		public function structureTweets($rawTweets){
			$tweets = array();
			foreach ($rawTweets as $key => $rawTweet) {
				$tweet = new \StdClass;

				$tweet->retweeted = isset($rawTweet->retweeted_status) ? 1:0 ;

				$canonicalTweet = $tweet->retweeted? $rawTweet->retweeted_status : $rawTweet;
				$canonicalUser = $canonicalTweet->user;
				if (isset($canonicalTweet->entities->media)) {
					$tweet->media = $canonicalTweet->entities->media[0]->media_url;
				}
				$tweet->id = $canonicalTweet->id ;
		
				$content = (new \LebaneseTweets\Utilities\TweetContentParser($canonicalTweet))->parse();
				$tweet->content = $content;
				$tweet->username = 	$canonicalUser->screen_name;
				$tweet->user_image = $canonicalUser->profile_image_url;
				$tweet->tweet_date = (new \Carbon\Carbon)->parse($rawTweet->created_at);
				$tweet->retweets = $canonicalTweet->retweet_count;
				$tweet->favorites = $canonicalTweet->favorite_count;
				$tweets[] = $tweet;
		}
			return $tweets;
		}

	}

?>

