<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->nullable();
			$table->integer('assigned_from')->nullable();
			$table->string('title');
			$table->text('description');
			$table->integer('priority')->default(0);
			$table->string('file_url')->nullable();
			$table->integer('stage')->default(1);
			$table->string('slug')->unique();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('accepted_at');
            $table->dateTime('started_at');
            $table->dateTime('completed_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tasks');
	}

}
