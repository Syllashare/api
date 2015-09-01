<?php

namespace Syllashare\Component\Period\Model;

use Eloquent;

class Period extends Eloquent
{	
	/**
	 * belongsTo DaySchedule
	 */ 
	public function daySchedule()
	{
		return $this->belongsToMany('Syllashare\Component\Schedule\Day\DaySchedule\Model\DaySchedule');
	}

	public function users()
	{
		return $this->belongsToMany('Syllashare\Accounts\User\Model\User', 'day_schedule_period', 'day_schedule_id', 'period_id');
	}
}