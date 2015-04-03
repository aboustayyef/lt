<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use \LebaneseTweets\Tweep;
use \LebaneseTweets\Mp;

class importMpsToTweeps extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseTweets:importMpsToTweets';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'A one-time Script to import mps into the Tweeps Table';

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
		$mps = Mp::all();
		foreach ($mps as $key => $mp) {
			
			$tweep = new Tweep;

			// public_name = firstname lastname
			$tweep->public_name = $mp->first_name . ' ' . $mp->last_name;

			// twitterHandle stays the same
			$tweep->twitterHandle = $mp->twitterHandle;

			$tweep->group = 'Politicians';

			$tweep->subgroups = $mp->district . ' , ' . $mp->party . ' , ' . $mp->sect; 
			
			$tweep->save();
		}
	}

}
