<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectiveJobFunctionSubCategoryNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('objective_job_function_sub_category_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('objective_id')->unsigned()->nullable();
			$table->integer('job_function_id')->unsigned()->nullable();
			$table->integer('sub_category_id')->unsigned()->nullable();
			$table->timestamps();

			//$table->foreign('job_title_id')->references('id')->on('job_titles');
			//$table->foreign('job_function_id')->references('id')->on('job_functions');
			//$table->foreign('job_seniority_level_id')->references('id')->on('job_seniority_levels');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('objective_job_function_sub_category_nodes');
	}

}
