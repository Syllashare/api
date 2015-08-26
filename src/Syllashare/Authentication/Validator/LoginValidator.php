<?php

namespace Syllashare\Authentication\Validator;

use Syllashare\Security\Validator\ValidatorAbstract;
use Syllashare\Accounts\User\Model\User;

/**
 * The validator for login authentication
 * @author Elliot Anderson <elliot@booksmart.it>
 */

class LoginValidator extends ValidatorAbstract
{
	protected $required = array(
		'email',
		'password'
	);

	public function __construct()
	{
		parent::__construct();

		$this->setRequired($this->required);
	}
}