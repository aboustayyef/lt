<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {

	protected $guarded = array('id', 'created_at', 'updated_at');

	public function mp(){
		return $this->belongsTo('\LebaneseTweets\Mp');
	}

}
