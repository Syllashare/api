<?php

namespace Syllashare\Authentication\Controller;

use BaseController;
use Syllashare\Accounts\User\Model\User;
use Auth;
use Input;
use Hash;
use Syllashare\Authentication\Validator\LoginValidator;

/**
 * This class handles all requests related to user authentication
 * i.e. login and register
 * @author Elliot Anderson <elliot@booksmart.it>
 */

class AuthController extends BaseController
{
	/**
	 * @var loginValidator
	 * service to validate the input
	 */
	protected $loginValidator;

	public function __construct(LoginValidator $loginValidator)
	{
		$this->loginValidator = $loginValidator;
	}

	/**
	 * handleLogin
	 */
	public function handleLogin()
	{		

		$validator = $this->loginValidator->validate();

		if ($validator->failed()) {
			$error = new \stdClass;
			$error->error = $validator->getError();

			// authentication failed
			return json_encode($error);
		}

		$input = $validator->getInput();

		$email = $input['email'];
		$password = $input['password'];


		if (Auth::attempt(array('email' => $email, 'password' => $password)))
		{
		    $user = Auth::user();

		    return $user->toJson();
		}

		$error = new \stdClass;
		$error->error = 'Invalid Credentials';

		// authentication failed
		return json_encode($error);
	}

	public function handleRegister()
	{
		$user = new User;
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->auth_key = Hash::make(Input::get('first_name').' '.Input::get('password'));
		$user->graduating_year = '2017';
		$user->save();
	}
}