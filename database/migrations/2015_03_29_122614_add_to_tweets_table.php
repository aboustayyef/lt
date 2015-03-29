<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToTweetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tweets', function(Blueprint $table) {
            $table->integer('journalist_id')->nullable();
            $table->integer('blogger_id')->nullable();
            $table->integer('artist_id')->nullable();
        });

        // make mp_id nullable;
        DB::statement('ALTER TABLE `tweets` MODIFY `mp_id` INTEGER UNSIGNED NULL;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tweets', function(Blueprint $table) {
            $table->dropColumn('journalist_id');
            $table->dropColumn('blogger_id');
            $table->dropColumn('artist_id');
        });
	// make mp_id un_nullable;
    DB::statement('ALTER TABLE `tweets` MODIFY `mp_id` INTEGER UNSIGNED;');
	}
}
