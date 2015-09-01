<?php

namespace Syllashare\Component\Period\Controller;

use Syllashare\Core\Controller\CoreController;
use Syllashare\Component\Period\Validator\PeriodValidator;

class PeriodController extends CoreController
{	
	/**
	 * @var PeriodValidator
	 */
	protected $periodValidator;

	public function __construct(PeriodValidator $periodValidator)
	{
		$this->periodValidator = $periodValidator;
	}

	/**
	 * Add a list of periods to the currently logged in user
	 * @return array of either success or error message
	 */
	public function add()
	{
		$validator = new PeriodValidator();

		if ($validator->hasErrorMessage()) {
			return new Error($validator->getError());
		}

		$validator = $validator->validate();

		$input = $validator->getInput();

		foreach ($input['periods'] as $period)
		{
			$period->users()->attach($period);
		}

		return array('success' => 'Periods added!');
	}
}