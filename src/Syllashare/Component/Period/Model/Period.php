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
		return $this->belongsTo('Syllashare\Component\Schedule\Day\DaySchedule\Model\DaySchedule');
	}
}