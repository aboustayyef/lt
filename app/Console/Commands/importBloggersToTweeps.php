<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use \LebaneseTweets\Tweep;

class importBloggersToTweeps extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseTweets:importBloggersToTweeps';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'A one-time Script to import bloggers into the Tweeps Table';

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
		//
		$listofUsernames = array();

		$filecontent = file('/Users/stayyef/Desktop/blogs.csv');
		$lines = explode('|', $filecontent[0]);
		
		$twitterClient = new \LebaneseTweets\Twitter\TweetsGetter;

		foreach ($lines as $key => $line) {

			$line = str_replace('"', '', $line);
			$line = explode(',', $line);
			$username = array_shift($line);
			$tags = implode(' , ', $line);
			// avoid duplicates
			if (in_array($username, $listofUsernames)	) {
				continue;
			}

			$tweep = new Tweep;

			$tweep->public_name = $twitterClient->getNameFromHandle($username);

			// twitterHandle stays the same
			$tweep->twitterHandle = $username;

			$tweep->group = 'Bloggers';

			$tweep->subgroups = $tags; 
			
			$tweep->save();
			
			$listofUsernames[] = $username;
			$this->comment('Added ' . $username);
			sleep(3);
		}

	}

}
