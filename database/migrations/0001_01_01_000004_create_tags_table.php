<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('slug')->nullable();
			$table->timestamps();
		});

        Schema::create('content_item_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_item_id')->unsigned()->index();         
            $table->integer('tag_id')->unsigned()->index();            
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
        Schema::drop('content_item_tag');
		Schema::drop('tags');
	}

}
