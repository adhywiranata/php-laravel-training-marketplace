<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoryTrainingTitleNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_category_training_title_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('training_title_id')->unsigned();
			$table->integer('sub_category_id')->unsigned();
			$table->timestamps();

			$table->foreign('training_title_id')->references('id')->on('training_titles');
			$table->foreign('sub_category_id')->references('id')->on('sub_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sub_category_training_title_nodes');
	}

}
