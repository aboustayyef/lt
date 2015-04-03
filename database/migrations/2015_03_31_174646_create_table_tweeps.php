<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTweeps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// first, create the table
		Schema::create('tweeps', function(Blueprint $table) {
            $table->increments('id');
            $table->string('public_name')->unique();
            $table->string('twitterHandle')->unique();
            $table->string('group');
            $table->string('subgroups');
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

		Schema::drop('tweeps');
	}

}
