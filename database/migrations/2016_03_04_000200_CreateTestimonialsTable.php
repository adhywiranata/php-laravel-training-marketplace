<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testimonials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('owner_id')->unsigned()->nullable();
			$table->integer('giver_id')->unsigned()->nullable();
			$table->string('testimony',255);
			$table->timestamps();

			//$table->foreign('owner_id')->references('id')->on('user');
			//$table->foreign('giver_id')->references('id')->on('user');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testimonials');
	}

}
