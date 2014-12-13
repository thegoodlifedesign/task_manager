<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
			$table->string('username')->unique();
			$table->string('password', '60');
			$table->string('slug')->unqiue();
            $table->string('remember_token', '100');
            $table->boolean('is_active')->default(0);
            $table->integer('role')->default(2);
			$table->dateTime('created_at');
			$table->dateTime('updated_at');
			$table->dateTime('deleted_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
