<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DayschedulePeriodMany2many extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('periods', function($table)
		{
			$table->dropColumn('day_schedule_id');
		});

		Schema::create('day_schedule_period', function($table)
		{
			$table->integer('day_schedule_id');
			$table->integer('period_id');
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
		Schema::table('periods', function($table)
		{
			$table->integer('day_schedule_id');
		});

		Schema::drop('day_schedule_period');
	}

}
