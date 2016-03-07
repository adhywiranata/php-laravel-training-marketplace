<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingExperiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_experiences', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('training_experience',100);
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('provider_id')->unsigned()->nullable();
			$table->integer('corporate_id')->unsigned()->nullable();
			$table->text('description');
			$table->date('start_date');
			$table->date('end_date');
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
		Schema::drop('training_experiences');
	}

}
