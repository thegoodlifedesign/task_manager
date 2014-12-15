<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('task_id')->nullable();
			$table->string('website_link');
			$table->string('related_links');
			$table->date('due_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('task_details');
	}
}
