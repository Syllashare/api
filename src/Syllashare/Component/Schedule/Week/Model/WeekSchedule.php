<?php

namespace Syllashare\Component\Schedule\Week\Model;

use Eloquent;

/**
 * A WeekSchedule is a collection of DaySchedule objects.  While this is not a solid
 * object that the user can see, it is simply an abstraction collection for the registration process,
 * to see the user's schedule.
 */

class WeekSchedule extends Eloquent
{
	protected $table = 'weekschedules';

	/**
	 * belongsTo Year
	 */
	public function year()
	{
		return $this->belongsTo('Syllashare\Component\Date\Year\Model\Year', 'week_schedule_id');
	}

	/**
	 * hasMany DaySchedule
	 */
	public function daySchedules()
	{
		return $this->hasMany('Syllashare\Component\Schedule\Day\Model\DaySchedule');
	}

	/**
	 * This method will format the data to be returned to the api.
	 * aggregates all of the dayschedule objects
	 * @return collection of DaySchedule object (collection of period object)
	 */
	public function format()
	{

		$day_schedules = $this->daySchedules()->get();

		// loop through each day schedule and run the format() method 
		$day_schedules->each(function($day_schedule) {

			return $day_schedule->format();

		});

		return $day_schedules;
	}
}