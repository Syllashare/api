<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('years', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('start_day');
			$table->integer('end_day');
			$table->integer('school_id');
			$table->timestamps();
		});	

		Schema::create('days', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('type');
			$table->boolean('active');
			$table->date('date');
			$table->integer('year_id');
			$table->integer('day_schedule_id');
			$table->timestamps();
		});	

		Schema::create('dayschedules', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description', 500)->nullable();
			$table->integer('week_schedule');
			$table->timestamps();
		});

		Schema::create('weekschedules', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description', 500)->nullable();
			$table->integer('year_id');
			$table->timestamps();
		});

		Schema::create('periods', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->time('start');
			$table->time('end');
			$table->integer('day_schedule_id');
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
		//
		Schema::drop('years');

		Schema::drop('days');
		
		Schema::drop('dayschedules');

		Schema::drop('weekschedules');

		Schema::drop('periods');

	}


}
