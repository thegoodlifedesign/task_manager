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
			$table->integer('task_id')->unsigned();
			$table->string('website_link')->nullable();
			$table->string('related_link')->nullable();
			$table->date('due_date');
			$table->integer('completion_time')->nullable();
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
		Schema::drop('task_details');
	}
}
