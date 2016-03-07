<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoryJobFunctionNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_category_job_function_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_function_id')->unsigned()->nullable();
			$table->integer('sub_category_id')->unsigned()->nullable();
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
		Schema::drop('sub_category_job_function_nodes');
	}

}
