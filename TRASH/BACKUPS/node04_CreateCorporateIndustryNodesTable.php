<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateIndustryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corporate_industry_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('corporate_id')->unsigned();
			$table->integer('industry_id')->unsigned();
			$table->timestamps();

			$table->foreign('corporate_id')->references('id')->on('corporates');
			$table->foreign('industry_id')->references('id')->on('industries');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('corporate_industry_nodes');
	}

}
