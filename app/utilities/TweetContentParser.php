<?php namespace LebaneseTweets\Utilities;

	/**
	* Takes a tweet object and returns a pretty HTML content body
	*
	* The text element of a tweet object gives us a raw plain text. This class
	* converts that text into html that inlcudes links to tweets and to articles
	*
	* @param $tweet (tweet object)
	* @return $html
	*/

	class TweetContentParser
	{
		
		private $tweet;

		function __construct($tweet)
		{
			$this->tweet = $tweet;
		}

		function parse(){


			$retweeted = isset($this->tweet->retweeted_status) ? 1:0 ;
			$canonicalTweet = $retweeted? $this->tweet->retweeted_status : $this->tweet;
			$canonicalUser = $canonicalTweet->user;

			// get original text
			$originalText = $canonicalTweet->text;

			// replace t.co links with pretty links and make them linkable
			//
			//
			$numberOfUrls = count($canonicalTweet->entities->urls);
			
			$content ="";
			if ($numberOfUrls > 0) {
				$parts = preg_split('#http(s)?://t\\.co/\\w+#',$originalText);

				$counter = 0;
				while ( $counter < $numberOfUrls) {
					$urlObject = $canonicalTweet->entities->urls[$counter];
					$expanded_url = $urlObject->expanded_url;
					$display_url = $urlObject->display_url;

					$content .= $parts[$counter];
					$content .= '<a href="' . $expanded_url . '">' . $display_url . '</a>';
					
					$counter++;
				}
				$content .= $parts[$counter];
			} else {
				$content = $originalText;
			}

			// replace @words with twitter links to profiles
			
			$content = preg_replace("#@(\\w+)#um", "<a href=\"http://twitter.com/$1\">@$1</a>", $content);
			
			return $content;



		}

	}

?>

