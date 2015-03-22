<?php namespace LebaneseTweets\Http\Controllers;

use LebaneseTweets\Http\Requests;
use LebaneseTweets\Http\Controllers\Controller;
use LebaneseTweets\Mp;
use LebaneseTweets\Tweet;
use Illuminate\Http\Request;
use \LebaneseTweets\Utilities\getTweetsFromRequest;

class MpsController extends Controller {

	public function index(Request $request){

		$tweets = (new getTweetsFromRequest($request))->getLatest(50);
		return view('mps.home')->with('tweets', $tweets)->with('request', $request);	

	}

}