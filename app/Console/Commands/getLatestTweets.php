<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use LebaneseTweets\Mp;
use LebaneseTweets\Tweet;

/**
 *	Usage: LebaneseTweets:getLatest mps|journalists|bloggers 
 */

class getLatestTweets extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseTweets:getLatest';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'gets the latest tweets and saves them to database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		$sourceType = $this->argument('tweetsSource');

		// Get group
		switch ($sourceType) {
			case 'mps':
				$group = Mp::all();
				break;
			case 'journalists':
				die('model not ready yet');
				break;
			case 'bloggers':
				die('model not ready yet');
			break;
			default:
				die('Argument should be either mps, bloggers or journalists');
			break;
		}
		
		foreach ($group as $key => $member) {
			try {
				$tweets = $member->getLatestTweets(5);
				foreach ($tweets as $key => $tweet) {

					// if tweet doesn't exists, save it				
					if (Tweet::where('twitter_id', $tweet->id)->count() == 0 ) {
						$tweetRecord = new Tweet();
						$status = $tweetRecord->store($tweet, $sourceType, $member->id);
						$this->comment($status);
					}
				}			
			} catch (Exception $e) {
				$this->error('error retreiving a tweet by ' . $member->twitterhandle);
			}
	
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['tweetsSource', InputArgument::REQUIRED, 'Source Of Tweets, examples: mps, journalists or bloggers'],
		];
	}

}
