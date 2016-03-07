<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectiveSubObjectiveNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('objective_sub_objective_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('objective_id')->unsigned()->nullable();
			$table->integer('sub_objective_id')->unsigned()->nullable();
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
		Schema::drop('objective_sub_objective_nodes');
	}

}
