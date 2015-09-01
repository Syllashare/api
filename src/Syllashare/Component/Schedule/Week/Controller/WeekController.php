<?php

namespace Syllashare\Component\Schedule\Week\Controller;

use Syllashare\Core\Controller\CoreController;
use Carbon\Carbon;

/**
 * CRUD Controller for the WeekSchedules
 */

class WeekController extends CoreController
{
	/**
	 * This will return the WeekSchedule Object, which is by definition
	 * a collection of periods that are stemmed from this database abstraction 
	 */
	public function get()
	{

		$school = $this->auth->getUser()->getSchool();

		$years = $school->getYears();

		/* after testing, yield this on.  for now we will just return the first year 

		$active_year = $years->filter(function($year) {

			$now = Carbon::now();

			$start = new Carbon($year->startDay->date);

			$end = new Carbon($year->endDay->date);

			if ($now->between($start, $end)) {
				return $year;
			}
		});	
		*/

		$active_year = $years->first();

		$week_schedule = $active_year->getActiveWeekSchedule();

		return $week_schedule->format();
	}
}	