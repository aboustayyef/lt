<?php namespace LebaneseTweets\Utilities;

/**
* 
*/

class Url
{
	private $url;

	function __construct($url)
	{
		$this->url = $url;
	}

	public function isValid(){
		// for the url to be valid, it has to send a response, and it has to be short;
		if ($this->resolve()) {
			if ($this->isShort()) {
				if ($this->exists()) {
					return $this->url;
				}
			}
		}
		
		return false;
	}

	private function exists(){
		$header = get_headers($this->url, 1);
		echo "Checking if $this->url Exists \n"; 
		if (strpos($header[0], '20')) {
			return true;
		}
		echo "Nope. URL gives response code: $header[0]\n";
		return false;

	}

	public function isShort(){
		echo "Checking if url is too long\n";
		echo $this->url."\n";
		if (strlen($this->url) < 250) {
			return true;
		}
		echo "Sorry, url is too long. Skipping it \n";
		return false;
	}

	private function resolve(){
		echo "checking if $this->url resolves\n";
		$resolvedUrl = (new UrlResolver($this->url))->iterate();
		if ($resolvedUrl) {
			$this->url = $resolvedUrl;

			// ignore facebook links
			$parsed = parse_url($this->url);
			if ($parsed['host'] == 'www.facebook.com') {
				echo "Facebook Links not supported \n";
				return false;
			}
			
			return true;
		}
		echo "url does not resolve\n";
		return false;	
	}

}

?>