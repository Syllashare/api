<?php

namespace Syllashare\Component\Schedule\Week\Controller;

use Syllashare\Core\Controller\CoreController;

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
	}
}	