<?php namespace LebaneseTweets\Utilities;

/**
* Coordinates the scraping betweet Simple Scraper and Alternative Scraper
* For Title and Description, the alternative Scraper has priority because of UTF-8
* For Images, The Simple Scraper is better because it saves us looking for and measuring images
*/

class Scraper
{
	private $simpleScraper, $alternativeScraper;

	function __construct($url)
	{

		echo "it exists. We'll scrape it now\n";
		$this->simpleScraper = new SimpleScraper($url);
		$this->alternativeScraper = new AlternativeScraper($url);
	}

	function getTitle(){
		echo "Trying Alternative Scraper\n";
		if ($this->alternativeScraper->getTitle()){
			return $this->alternativeScraper->getTitle();
		}
		echo "Trying Simple Scraper\n";
		if ($this->simpleScraper->getTitle()) {
			return $this->simpleScraper->getTitle();
		}
		return false;
	}
	function getDescription(){
		echo "Trying Alternative Scraper\n";
		if ($this->alternativeScraper->getDescription()){
			return $this->alternativeScraper->getDescription();
		}
		echo "Trying Simple Scraper\n";
		if ($this->simpleScraper->getDescription()) {
			return $this->simpleScraper->getDescription();
		}
		return false;
	}
	function getImage(){
		echo "Trying Simple Scraper\n";
		if ($this->simpleScraper->getImage()) {
			return $this->simpleScraper->getImage();
		}
		echo "Trying Alternative Scraper\n";
		if ($this->alternativeScraper->getImage()){
			return $this->alternativeScraper->getImage();
		}
		return false;
	}
}