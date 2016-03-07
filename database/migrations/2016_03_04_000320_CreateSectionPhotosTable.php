<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('section_photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('section_id')->unsigned()->nullable();
			$table->integer('section_item_id')->unsigned()->nullable();
			$table->string('photo_name',100);
			$table->string('photo_path',255);
			$table->text('photo_description');
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
		Schema::drop('section_photos');
	}

}
