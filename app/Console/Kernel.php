<?php namespace LebaneseTweets\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'LebaneseTweets\Console\Commands\Inspire',
		'LebaneseTweets\Console\Commands\getLatestTweets',
		'LebaneseTweets\Console\Commands\refreshListOfMps',
		'LebaneseTweets\Console\Commands\importMpsToTweeps',
		'LebaneseTweets\Console\Commands\importBloggersToTweeps'
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();
	}

}
