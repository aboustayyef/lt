<?php namespace LebaneseTweets\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use LebaneseTweets\Mp;
use LebaneseTweets\Tweet;

class refreshListOfMps extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseTweets:refreshListOfMps';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'refresh the list of mps from the nouwweb api';

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

		// get json data from Mps api
		$allMps = @file_get_contents('http://api.nouwweb.pw/search?twitter=true');

		if ($allMps) { 
			
			// convert to array
			$MpsObject = json_decode($allMps);
			
			foreach ($MpsObject as $key => $mp) {

				//extract twitter handle
				$twitterParts = explode('/',$mp->twitter);
				$twitterHandle = array_pop($twitterParts);

				// check if record exists in database with such a handle;
				$recordExists = Mp::where('twitterHandle', $twitterHandle)->count();
				
				if ($recordExists) {
					// replace content of existing record
					$record = Mp::where('twitterHandle', $twitterHandle)->first();
					$this->comment('Editing records of ' . $mp->first_name . ' ' . $mp->last_name);
				}else{
					// create new record
					$record = new Mp;
					$this->comment('Adding new record of ' . $mp->first_name . ' ' . $mp->last_name);
				}

				$record->first_name = $mp->first_name;
				$record->last_name = $mp->last_name;
				$record->gender = $mp->gender;
				$record->district = $mp->district;
				$record->twitterHandle = $twitterHandle;
				$record->party = $mp->party;
				$record->sect = $mp->sect;
				$record->age = date('Y') - $mp->born_year;
				$record->save();
			}

			return true;
		}

		return false;
	}

}
