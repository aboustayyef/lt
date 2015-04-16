<?php namespace LebaneseTweets\Twitter;

	
	class GetNameOfUser
	{
		
		function __construct()
		{
			#nothing
		}
	
		public function extract($twitterHandle){
			$raw = shell_exec('grep https://twitter.com/' . $twitterHandle . ' | grep \<title\>');
			return $raw;
		}
	}

?>