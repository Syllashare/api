<?php

namespace Syllashare\Component\Period\Validator;

use Syllashare\Security\Validator\ValidatorAbstract;
use Illuminate\Support\Collection;
use Syllashare\Component\Period\Model\Period;

class PeriodValidator extends ValidatorAbstract
{
	// require a list of periods
	protected $required = array(
		'periods'
	);

	public function __construct()
	{
		parent::__construct();

		$this->normalize('periods', function($periods) {

			$normalized_periods = new Collection;

			foreach ($periods as $period) {
				$period = Period::find($period);

				if (is_null($period)) {
					$this->throwError('Invalid Period Input');
				}

				$normalized_periods->push($period);
			}

			return $normalized_periods;
			
		});
	}
	
}