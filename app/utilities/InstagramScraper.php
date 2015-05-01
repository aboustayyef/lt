<?php namespace LebaneseTweets\Utilities;
use \Exception;
class InstagramScraper
{
	protected $content;
	function __construct($url)
	{
		// First, Check if photo still exists
		// Sometimes, people tweet an instagram photo
		// then they delete it latest for one of many reasons

		$header = get_headers($url, 1);
		if ($header[0] == "HTTP/1.1 404 NOT FOUND") {
			echo "Sorry, Instagram photo no longer exists \n";
			return false;
		} else {
			$this->content = @file_get_contents($url);
		}

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