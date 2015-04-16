<?php namespace LebaneseTweets\Http\Requests;

use LebaneseTweets\Http\Requests\Request;

class CreateTweepRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'public_name'	=>	'required',
			'twitterHandle'	=>	'required',
			'group'	=>	'required',
			'subgroups'	=>	'required',
		];
	}

}
