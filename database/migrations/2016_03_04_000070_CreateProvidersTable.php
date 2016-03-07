<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('provider_position_id')->nullable();
			$table->string('email')->unique();
			$table->string('provider_name',50);
			$table->text('summary');
			$table->text('domicle_area');
			$table->text('service_area');
			$table->string('phone_number',20);
			$table->string('profile_picture',100);
			$table->string('training_method',255);
			$table->string('training_style',255);
			$table->bigInteger('mandays_fee');
			$table->string('slug',255);
			$table->char('is_verified',1);
			$table->timestamps();
			$table->softDeletes();

			//$table->foreign('provider_position_id')->references('id')->on('provider_positions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('providers');
	}

}
