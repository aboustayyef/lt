<?php namespace LebaneseTweets\Commands;

use LebaneseTweets\Commands\Command;
use \LebaneseTweets\Link;
use Illuminate\Contracts\Bus\SelfHandling;

use \LebaneseTweets\Utilities\SimpleScraper;

class ProcessLink extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 * If link exists in Database, returns link id
	 * If not, scrape and see if worthwhile
	 * if worthwhile, add to database and return id
	 * if not, return false 
	 *
	 * @return void
	 */
	
	protected $url;

	public function __construct($url)
	{
		// to do: make sure url is valid
		$this->url = $url;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if (Link::Where('url', $this->url)->count() == 0) {
			# only process if this url doesn't already exist
		$info = new SimpleScraper($this->url);
		var_dump($info->getAllData());
		}
	}

}
