<?php namespace LebaneseTweets\Http\Controllers;

use LebaneseTweets\Http\Requests;
use LebaneseTweets\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SessionController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	
	public function __construct(){
		$this->middleware('auth', ['only'=>['create']])
	}


	public function create()
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
