<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixDayscheduleForeignKey extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('dayschedules', function($table)
		{
			$table->dropColumn('week_schedule');
			$table->integer('week_schedule_id');
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
		Schema::table('dayschedules', function($table)
		{
			$table->integer('week_schedule');
			$table->dropColumn('week_schedule_id');
		});
	}

}
