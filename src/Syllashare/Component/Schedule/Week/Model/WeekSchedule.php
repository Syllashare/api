<?php

namespace Syllashare\Component\Schedule\Week\Model;

use Eloquent;

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
}