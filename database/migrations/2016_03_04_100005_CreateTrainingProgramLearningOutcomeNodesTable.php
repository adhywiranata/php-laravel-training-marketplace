<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingProgramLearningOutcomeNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_program_learning_outcome_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('learning_outcome_id')->unsigned();
			$table->integer('training_program_id')->unsigned();
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
		Schema::drop('training_program_learning_outcome_nodes');
	}

}
