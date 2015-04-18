<?php namespace LebaneseTweets\Utilities;

class InstagramScraper
{
	protected $content;
	function __construct($url)
	{
		$this->content = @file_get_contents($url);
	}

	public function image(){
		preg_match('#<meta +property=\\"og:image\\" +content=\\"(http.+?\.jpg)\\"#', $this->content, $result);
		if (count($result) > 1) {
			return $result[1];
		}
		return false;	
	}
}
?>