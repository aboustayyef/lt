<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('links', function(Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique();
            $table->string('title');
            $table->text('excerpt');
            $table->string('image');
            $table->integer('image_height');
            $table->integer('image_width');
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
		Schema::drop('links');
	}

}
