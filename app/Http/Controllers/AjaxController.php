<?php namespace LebaneseTweets\Http\Controllers;

use LebaneseTweets\Http\Requests;
use LebaneseTweets\Http\Controllers\Controller;

use LebaneseTweets\Tweet;
use Illuminate\Http\Request;

class AjaxController extends Controller {

	public function index($group = 'null', $from = 0, $to = 20, Request $request){
		if ($group == 'all') {
			$group = null;
		}
		
		$result = '';

		$tweets = Tweet::query($group, $from, $to, $request);

		foreach ($tweets as $key => $tweet) {
			$result .= view('layouts.partials.tweet')->with('tweet', $tweet);
		}

		return $result;
	}

}
