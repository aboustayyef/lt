<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToTweets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tweets', function(Blueprint $table) {
            $table->string('tweep_public_name');
            $table->string('tweep_twitterHandle');
            $table->string('tweep_subgroups');
            $table->string('tweep_group');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tweets', function(Blueprint $table) {
            $table->dropColumn('tweep_public_name');
            $table->dropColumn('tweep_twitterHandle');
            $table->dropColumn('tweep_subgroups');
            $table->dropColumn('tweep_group');
        });
	}

}
