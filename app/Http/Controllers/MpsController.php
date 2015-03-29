<?php namespace LebaneseTweets\Http\Controllers;

use LebaneseTweets\Http\Requests;
use LebaneseTweets\Http\Controllers\Controller;
use LebaneseTweets\Mp;
use LebaneseTweets\Tweet;
use Illuminate\Http\Request;
use \LebaneseTweets\Utilities\getTweetsFromRequest;

class MpsController extends Controller {

	/**
	 * Gets Tweets based on the url parameters filtering
	 * @param  Request $request [Url Parameters]
	 * @return [type]           gets list of tweets.
	 */
	public function index(Request $request){

		$tweets = self::filterTweets($request, 0, 50);
		return view('mps.home')->with('tweets', $tweets)->with('request', $request);	

	}

	private static function filterTweets($request, $from, $to){

	// build the query - hideretweets, district, party, sect
	$queryBuilder = \DB::table('tweets')->Join('mps','tweets.mp_id','=', 'mps.id');

	if (($request->has('hideretweets')) && ($request->get('hideretweets') == 'yes')) {
		$queryBuilder = $queryBuilder->Where('is_retweet',0);			# code...
	}

	if ($request->has('district')) {
		$queryBuilder = $queryBuilder->Where('district', $request->get('district'));
	}

	if ($request->has('sect')) {
		$queryBuilder = $queryBuilder->Where('sect', $request->get('sect'));
	}

	if ($request->has('party')) {
		$queryBuilder = $queryBuilder->Where('party', $request->get('party'));
	}

	$tweets = $queryBuilder->take($to)->skip($from)->orderBy('tweet_date','desc')->get();
	return $tweets;
}

}