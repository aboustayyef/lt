<?php namespace LebaneseTweets\Http\Controllers;

use LebaneseTweets\Http\Requests;
use LebaneseTweets\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LebaneseTweets\Tweet;
use LebaneseTweets\Tweep;

class streamController extends Controller {

	private $allowedGroups = ['politicians','bloggers'];

	public function index(Request $request, $group = null){

		// prevent upper cases 
		$group = strtolower($group);
		
		if ($group && !in_array($group, $this->allowedGroups)) {
			return \Redirect::to('/');
		}
		
		$tweets = Tweet::query($group, 0, 20, $request);

		return view('layouts.main')->with(array('tweets'=>$tweets, 'request',$request));

	}

}
