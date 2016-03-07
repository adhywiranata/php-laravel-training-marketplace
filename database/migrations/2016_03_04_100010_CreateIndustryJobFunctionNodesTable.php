<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryJobFunctionNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('industry_job_function_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('objective_id')->unsigned();
			$table->integer('sub_objective_id')->unsigned();
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
		Schema::drop('industry_job_function_nodes');
	}

}
