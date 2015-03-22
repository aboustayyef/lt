<?php namespace LebaneseTweets\Utilities;

use \LebaneseTweets\Mp;

	/**
	* 
	*/

	class RefreshListOfMps
	{
		

		function __construct()
		{
		}

		function refresh()	{

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
				}else{
					// create new record
					$record = new Mp;
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

?>

