<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustrySubCategoryNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('industry_sub_category_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('industry_id')->unsigned()->nullable();
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
		Schema::drop('industry_sub_category_nodes');
	}

}
