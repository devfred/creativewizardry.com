<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_items', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->text('excerpt');
            $table->text('content');
            $table->string('slug')->nullable();
			$table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();



		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('content_items');
	}

}
