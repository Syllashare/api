<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixUserSchoolRelationship extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::drop('school_user');

		Schema::table('users', function($table)
		{
			$table->integer('school_id');
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
		Schema::create('school_user', function($table)
			{
				$table->integer('school_id');
				$table->integer('user_id');
			});

		Schema::table('users', function($table)
		{
			$table->dropColumn('school_id');
		});
	}

}
