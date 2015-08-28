<?php

namespace Syllashare\Authentication\Validator;

use Syllashare\Security\Validator\ValidatorAbstract;
use Hash;
use Syllashare\Component\School\Model\School;

class RegisterValidator extends ValidatorAbstract
{
	protected $required = array(
		'first_name',
		'last_name',
		'email',
		'password'
	);

	protected $rules = array(
		'email' => 'unique:users',
		'password' => 'min:3'
	);

	public function __construct()
	{
		parent::__construct();

		$this->setRequired($this->required);

		// hash the password

		$this->normalize('password', function($password) {
			return Hash::make($password);
		});

		$this->normalize('auth_key', function() {
			$first_name = $this->first_name;
			$password = $this->password;

			return Hash::make($first_name.' '.$password);
		});

		$this->normalize('graduating_year', function() {
			return '2017';
		});

		$this->normalize('school', function() {
			return School::first();
		});

	}
}