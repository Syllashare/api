<?php

namespace Syllashare\Authentication\Validator;

use Syllashare\Security\Validator\ValidatorAbstract;

class RegisterValidator extends ValidatorAbstract
{
	protected $required = array(
		'first_name',
		'last_name',
		'email',
		'password'
	);

	protected $rules = array(

	);

	public function __construct()
	{
		parent::__construct();

		$this->setRequired($this->required);

	}
}