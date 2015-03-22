<?php namespace LebaneseTweets\Utilities;

	/**
	* 
	*/

	class GetTweetsFromRequest
	{
		
		private $request;

		public function __construct($request)
		{
			$this->request = $request;
		}

		public function getLatest($howmany){

			// build the query - hideretweets, district, party, sect
			$queryBuilder = \DB::table('tweets')->Join('mps','tweets.mp_id','=', 'mps.id');

			if (($this->request->has('hideretweets')) && ($this->request->get('hideretweets') == 'yes')) {
				$queryBuilder = $queryBuilder->Where('is_retweet',0);			# code...
			}

			if ($this->request->has('district')) {
				$queryBuilder = $queryBuilder->Where('district', $this->request->get('district'));
			}

			if ($this->request->has('sect')) {
				$queryBuilder = $queryBuilder->Where('sect', $this->request->get('sect'));
			}

			if ($this->request->has('party')) {
				$queryBuilder = $queryBuilder->Where('party', $this->request->get('party'));
			}

			$tweets = $queryBuilder->take(50)->orderBy('tweet_date','desc')->get();
			return $tweets;
		}

	}

?>