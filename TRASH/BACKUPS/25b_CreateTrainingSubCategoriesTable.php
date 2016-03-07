<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_sub_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('training_category_id')->unsigned();
			$table->string('training_sub_category',255);
			$table->timestamps();

			$table->foreign('training_category_id')->references('id')->on('training_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('training_sub_categories');
	}

}
