<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFavoritesAndRetweetsToTweetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tweets', function(Blueprint $table) {
            $table->integer('favorites')->unsigned();
            $table->integer('retweets')->unsigned();
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
            $table->dropColumn('favorites');
            $table->dropColumn('retweets');
        });
	}

}
