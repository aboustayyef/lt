<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use \LebaneseTweets\Tweet;

class migrateOldTweets extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'LebaneseTweets:migrateOldTweets';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Takes old tweets and adds tweep info directly in the tweets table';

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
		$tweets = Tweet::all();
		foreach ($tweets as $key => $tweet) {
			$tweet->tweep_public_name = $tweet->tweep->public_name;
			$tweet->tweep_twitterHandle = $tweet->tweep->twitterHandle;
			$tweet->tweep_subgroups = $tweet->tweep->subgroups;
			$tweet->tweep_group = $tweet->tweep->group;
			$tweet->save();
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
			['example', InputArgument::OPTIONAL, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
