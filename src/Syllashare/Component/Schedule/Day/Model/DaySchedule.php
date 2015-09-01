<?php

namespace Syllashare\Component\Schedule\Day\Model;

use Eloquent;

/**
 * This is the abstraction object for a collection of period objects
 * used for displaying the schedule
 */
class DaySchedule extends Eloquent
{
	protected $table = 'dayschedules';
	
	/**
	 * hasMany Period
	 */
	public function periods()
	{
		return $this->belongsToMany('Syllashare\Component\Period\Model\Period', 'day_schedule_period' ,'day_schedule_id', 'period_id');
	}

	public function weekSchedule()
	{
		return $this->belongsTo('Syllashare\Component\Schedule\Week\Model\WeekSchedule');
	}

	public function format()
	{
		return $this->periods->transform();
	}
}