<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategorySkillNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_category_skill_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('skill_id')->unsigned();
			$table->integer('sub_category_id')->unsigned();
			$table->timestamps();

			//$table->foreign('skill_id')->references('id')->on('skills');
			//$table->foreign('sub_category_id')->references('id')->on('sub_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sub_category_skill_nodes');
	}

}
