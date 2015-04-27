<?php namespace LebaneseTweets\Http\Controllers;

use LebaneseTweets\Http\Requests;
use LebaneseTweets\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LebaneseTweets\Tweet;
use LebaneseTweets\Tweep;

class streamController extends Controller {

	private $allowedGroups = ['politicians','journalists', 'politicianstest'];

	public function index(Request $request, $group = null){

		// prevent upper cases 
		$group = strtolower($group);
		
		if ($group && !in_array($group, $this->allowedGroups)) {
			return \Redirect::to('/');
		}
		
		if ($group == 'politicianstest') {
			$tweets = (New Tweet)->makeQuery('politicians', 0, 20, $request);
			return $tweets;
		}
		$tweets = (New Tweet)->makeQuery($group, 0, 20, $request);

		return view('layouts.main')->with(array('tweets'=>$tweets, 'request'=>$request, 'group'=>$group));

	}

}
