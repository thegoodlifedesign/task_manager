<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task_statistics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('task_id')->unsigned()->index();
			$table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
			$table->integer('assigned_to');
			$table->integer('accepted_by')->nullable();
			$table->integer('started_by')->nullable();
			$table->integer('completed_by')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('task_statistics');
	}

}
