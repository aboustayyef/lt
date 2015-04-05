<?php namespace LebaneseTweets\Utilities;


	class TweetRenderer
	{
		
		private $tweet;

		function __construct($tweet)
		{
			$this->tweet = $tweet;
		}

		function toHtml(){

			$html ="";
			$html .= '<li class="card">';
			$html .= '<div class="cardheader">';
			$html .= $this->tweet->tweep_public_name;
			$html .= '</div>';
			$html .= '<div class="cardbody">';
			$html .= $this->tweet->tweet_content;
			$html .= '</div>';
			$html .= '<div class="cardfooter">';
			$html .= (new \Carbon\Carbon($this->tweet->tweet_created_at))->diffForHumans();
			$html .= '</div></li>';

			return $html;		
		}
	}
?>

