<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use LebaneseTweets\Tweep;
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
		$started = new \Carbon\Carbon;
		$this->Comment('*************************************************');
		$this->Comment('Process Started at: ' . $started);
		$this->Comment('*************************************************');
		
		$tweeps = null;

		// If argument is set and tweep exists, scope query to that account
		if ($this->argument('twitterHandle')) {
			if (Tweep::Where('twitterHandle', $this->argument('twitterHandle'))->count() > 0 ) {
				$tweeps = Tweep::Where('twitterHandle', $this->argument('twitterHandle'))->get();
			}
		}

		// otherwise use all tweeps
		if (!$tweeps) {
			$tweeps = Tweep::all();
		}

		
		
		$twitterClient = new \LebaneseTweets\Twitter\TweetsGetter;

		foreach ($tweeps as $key => $tweep) {
			$this->comment('Getting Tweets for user: ' . $tweep->twitterHandle);
			try {
				$tweets = $tweep->getLatestTweets($twitterClient, 10);
				foreach ($tweets as $key => $tweet) {


					// manage Raw Twitter Object
					$retweeted = isset($tweet->retweeted_status) ? 1:0 ;
					$canonicalTweet = $retweeted? $tweet->retweeted_status : $tweet;
					$canonicalUser = $canonicalTweet->user;

					// if tweet doesn't exists, save it	
					
					$this->info('twitter_id: ' . $canonicalTweet->id);
					$currentTweetExists = Tweet::where('twitter_id', $canonicalTweet->id);
					if ( $currentTweetExists->count() == 0 ) {
						$tweetRecord = new Tweet();
						$status = $tweetRecord->store($tweet, $tweep->id);
						$this->info($status);
					}else{
						$currentTweet = $currentTweetExists->first();
						$this->comment('Tweet Already stored. Updating Retweets and Faves');
						$currentTweet->favorites = $canonicalTweet->favorite_count;
						$currentTweet->retweets	= $canonicalTweet->retweet_count;
						$this->popularity_score = $currentTweet->favorites + ($currentTweet->retweets * 2);

						$currentTweet->save();
						$this->comment('updated! Retweets: ' . $canonicalTweet->retweet_count . ', Faves: ' . $canonicalTweet->favorite_count);
					}
				}			
				$this->info('Api Calls Remaining: '.$twitterClient->status());
				$this->comment('Waiting 5 seconds');
				sleep(5);
			} catch (Exception $e) {
				$this->error('error retreiving a tweet by ' . $tweep->twitterhandle);
			}
		}
	
	    $ended = new \Carbon\Carbon;
		$this->Comment('*************************************************');
		$this->Comment('Process ended at: ' . $ended);
		$this->Comment('Process Took ' . $started->diffInSeconds() . 'seconds');
		$this->Comment('*************************************************');	
	
	}
	
	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['twitterHandle', InputArgument::OPTIONAL, 'if twitter handle specified, get tweets of only that account'],
		];
	}

}
