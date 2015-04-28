<?php namespace LebaneseTweets\Utilities;

// Extracts web links meta data from Facebook Graph Tags.
// Source: https://github.com/ramonztro/simple-scraper/blob/master/SimpleScraper.class.php

use Symfony\Component\DomCrawler\Crawler ;

class AlternativeScraper {

	private $html;
	private $crawler;
	private $url_root;
	function __construct($url){
		
		$header = get_headers($url, 1);
		
		if ($header[0] == "HTTP/1.1 404 NOT FOUND") {
			echo "Sorry, url no longer exists \n";
			return false;
		}

		if ($html = @file_get_contents($url)) {
			$this->html = $html;
			$this->crawler = new Crawler;
			$this->crawler->addHTMLContent($this->html, 'UTF-8');
			
			// try to follow redirects to know the root of relative images
			$urlResolver = new UrlResolver($url);
			$resolvedUrl = $urlResolver->iterate();

			if ($resolvedUrl) {
				$url = $resolvedUrl;
			}

			$url = parse_url($url);
			$this->url_root = $url['scheme'] . '://' . $url['host'];

		} else {
			return false;
		}

	}
	public function getTitle(){
		if ($this->crawler->filter('title')->count() > 0) {
			return $this->crawler->filter('title')->text();
		}
		return false;
	}

	public function getDescription(){
		if ($this->crawler->filter("meta[name=description]")->count() > 0) {
			return $this->crawler->filter("meta[name=description]")->attr('content');
		}
		return false;
	}

	public function getImage(){
		if ($this->crawler->filter('img')->count() > 0 ) {
			$images = $this->crawler->filter('img');
			foreach ($images as $key => $image) {

			 	$imageSource = $image->getAttribute('src');
			 	$imageSource = $this->normalizeRoot($imageSource);
			 	
			 	if ($this->isLargeEnough($imageSource, 300)) {
			 		return $imageSource;
			 	}

			}
			return false; 
		}
	}

	/**
	 * converts relative images to absolute images
	 * @param   string $imageSource [Raw URL]
	 * @return  string $imageSource [Fixed URL]
	 */
	private function normalizeRoot($imageSource){
	 	if ((strpos($imageSource,'http') !== 0 )) {
	 		if (strpos($imageSource, '/') == 0) { // if is relative to root
	 			$imageSource = $this->url_root . $imageSource;
	 		} else {
	 			$imageSource = $this->url_root . '/' . $imageSource;
	 		}		 		
	 	}
	 	return $imageSource;
	}

	private function isLargeEnough($image, $minWidth){

		echo "Checking Image $image\n";
		// Check first if image exists
		$header = get_headers($image, 1);
		echo "Checking if $image Exists \n"; 
		if (strpos($header[0], '404')) {
			echo "Nope. It doesn't\n";
			echo "couldn't find $image \n";
			return false;
		}

		$dimensions = getimagesize($image);
		if ($dimensions[0] >= $minWidth) {
			return true;
		}
		return false;
	}
}