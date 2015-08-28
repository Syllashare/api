<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('schools', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('address');
			$table->string('email_domain');
			$table->timestamps();
		});

		Schema::create('school_user', function($table)
		{
			$table->integer('school_id');
			$table->integer('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('schools');

		Schema::drop('school_user');
	}

}
