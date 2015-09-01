<?php

namespace Syllashare\Component\Period\Validator;

use Syllashare\Security\Validator\ValidatorAbstract;
use Illuminate\Support\Collection;

class PeriodValidator extends ValidatorAbstract
{
	// require a list of periods
	protected $required = array(
		'periods'
	);

	public function __construct()
	{
		$this->normalize('periods', function($periods)
		{
			$normalized_periods = new Collection;

			foreach ($periods as $period) {
				$period = Period::find($period);

				if (is_null($period)) {
					$this->throwError('Invalid Period Input');
				}

				$normalized_periods->add($period);
			}

			return $normalized_periods;
			
		});
	}
	
}