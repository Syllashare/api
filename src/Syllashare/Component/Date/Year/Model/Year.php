<?php

namespace Syllashare\Component\Date\Year\Model;

use Eloquent;

/**
 * The idea of a 'year'. This is the school year component, that encompasses all the days of the school year
 * The only thing that a year actually owns, is a 'Day'
 * @see Syllashare\Component\Date\Day\Model\Day
 * @author Elliot Anderson <elliot@booksmart.it>
 */

class Year
{
	/**
	 * belongsTo School object
	 */
	public function school()
	{
		return $this->belongsTo('Syllashare\Component\Date\Year\Model\Year');
	}

	/**
	 * hasMany Days
	 */
	public function days()
	{
		return $this->hasMany('Syllashare\Component\Date\Day\Model\Day');
	}

	/**
	 * instance of the first day of the year
	 */
	public function startDay()
	{
		return $this->belongsTo('Syllashare\Component\Date\Day\Model\Day', 'start_day');
	}

	public function weekSchedules()
	{
		return $this->hasMany('Syllashare\Component\Schedule\Week\Model\WeekSchedule', 'week_schedule_id');
	}
}

