<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use LebaneseTweets\Mp;
use LebaneseTweets\Tweet;

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

		// Get Mps
		$mps = Mp::all();
		foreach ($mps as $key => $mp) {
			try {
				$tweets = $mp->getLatestTweetsFromTwitter(5);
				foreach ($tweets as $key => $tweet) {

					// if tweet doesn't exists, save it				
					if (Tweet::where('twitter_id', $tweet->id)->count() == 0 ) {
						// tweet doesn't exist, save
						$newRecord = Tweet::create([
							'mp_id' => $mp->id,
							'twitter_id' => $tweet->id,
							'content' => $tweet->content,
							'is_retweet' => $tweet->retweeted,
							'username' => $tweet->username,
							'user_image' => $tweet->user_image,
							'tweet_date' => $tweet->tweet_date,
							'media' => isset($tweet->media)? $tweet->media : null,
							'favorites' => $tweet->favorites,
							'retweets'	=> $tweet->retweets
						]);
						$this->comment('added tweet: http://twitter.com/'.$tweet->username.'/status/'.$tweet->id . ' F:'.$tweet->favorites.' R: '.$tweet->retweets);
					}
				}			
			} catch (Exception $e) {
				$this->error('error retreiving a tweet by ' . $mp->twitterhandle);
			}
	
		}
	}

}
