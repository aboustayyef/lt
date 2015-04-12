<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GetTweetDetails extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseTweets:GetTweetDetails';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Gets the details of a single tweet from its ID';

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
		$client = new \LebaneseTweets\Twitter\TweetsGetter;
		$details = $client->getTweetDetails($this->argument('tweetID'));
		$option = $this->option('detail');
		if ($this->option('detail')) {
			var_dump($details[0]->$option);
			return;
		}
		var_dump($details);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['tweetID', InputArgument::REQUIRED, 'Twitter Status id']
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
			['detail', null, InputOption::VALUE_OPTIONAL, 'details wanted', null],
		];
	}

}
