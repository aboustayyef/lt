<?php namespace LebaneseTweets\Utilities;

/**
* 
*/

class Scraper
{
	private $simpleScraper, $alternativeScraper;

	function __construct($url)
	{
		$this->simpleScraper = new SimpleScraper($url);
		$this->alternativeScraper = new AlternativeScraper($url);
	}

	function getTitle(){
		echo "Trying Simple Scraper\n";
		if ($this->simpleScraper->getTitle()) {
			return $this->simpleScraper->getTitle();
		}
		echo "Trying Alternative Scraper\n";
		if ($this->alternativeScraper->getTitle()){
			return $this->alternativeScraper->getTitle();
		}
		return false;
	}
	function getDescription(){
		echo "Trying Simple Scraper\n";
		if ($this->simpleScraper->getDescription()) {
			return $this->simpleScraper->getDescription();
		}
		echo "Trying Alternative Scraper\n";
		if ($this->alternativeScraper->getDescription()){
			return $this->alternativeScraper->getDescription();
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