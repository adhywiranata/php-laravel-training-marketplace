<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('corporate_id')->unsigned()->nullable();
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->string('first_name',50);
			$table->string('last_name',50);
			$table->text('summary');
			$table->text('domicle_area');
			$table->text('service_area');
			$table->text('address');
			$table->string('phone_number',20);
			$table->char('gender',1);
			$table->date('dob');
			$table->string('profile_picture',100);
			$table->string('job_title',255);
			$table->string('job_function',255);
			$table->string('job_seniority_level',255);
			$table->string('training_method',255);
			$table->string('training_style',255);
			$table->bigInteger('mandays_fee');
			$table->string('slug',255);
			$table->date('last_online');
			$table->char('is_verified',1);
			$table->char('is_tour',1);
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('corporate_id')->references('id')->on('corporates');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
