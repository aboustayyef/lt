<?php namespace LebaneseTweets\Utilities;
use \Exception;

/**
* 
*/

class UrlResolver
{

	protected $initialUrl;
	protected $url;
	protected $iterations;

	function __construct($initialUrl){
		$this->initialUrl = $initialUrl;
		$this->iterations = 1;
	}

	function iterate(){

		// start with initial url;
		$this->url = $this->get($this->initialUrl);

		echo "Round: $this->iterations, initial: $this->initialUrl, url: $this->url\n";

		// if false
		if (!$this->url) {
			return $this->initialUrl;
		}

		// if same, return
		if ($this->url == $this->initialUrl) {
			echo "The Same, $this->url\n";
			return $this->url;
		}

		// if not the same, do recursive magic;
		$this->initialUrl = $this->url;
		$this->iterations++;
		return $this->iterate();

	}
	
	function get($url){
	    $redirect_url = null; 

	    $url_parts = @parse_url($url);
	    if (!$url_parts) return false;
	    if (!isset($url_parts['host'])) return false; //can't process relative URLs
	    if (!isset($url_parts['path'])) $url_parts['path'] = '/';

	    $sock = fsockopen($url_parts['host'], (isset($url_parts['port']) ? (int)$url_parts['port'] : 80), $errno, $errstr, 30);
	    if (!$sock) return false;

	    $request = "HEAD " . $url_parts['path'] . (isset($url_parts['query']) ? '?'.$url_parts['query'] : '') . " HTTP/1.1\r\n"; 
	    $request .= 'Host: ' . $url_parts['host'] . "\r\n"; 
	    $request .= "Connection: Close\r\n\r\n"; 
	    fwrite($sock, $request);
	    $response = '';
	    while(!feof($sock)) $response .= fread($sock, 8192);
	    fclose($sock);

	    if (preg_match('/^[Ll]ocation: (.+?)$/m', $response, $matches)){
	        if ( substr($matches[1], 0, 1) == "/" )
	            return $url_parts['scheme'] . "://" . $url_parts['host'] . trim($matches[1]);
	        else
	            return trim($matches[1]);

	    } else {
	        return false;
	    }

	}
}

?>