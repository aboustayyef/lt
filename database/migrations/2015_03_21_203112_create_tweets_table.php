<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tweets', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mp_id')->nullable();
            $table->string('twitter_id');
            $table->text('content');
            $table->boolean('is_retweet');
            $table->string('username');
            $table->string('user_image');
            $table->timestamp('tweet_date');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tweets');
	}

}
