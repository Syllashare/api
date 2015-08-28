<?php

namespace Syllashare\Authentication\Controller;

use Syllashare\Accounts\User\Model\User;
use Auth;
use Input;
use Hash;
use Syllashare\Authentication\Validator\LoginValidator;
use Syllashare\Authentication\Validator\RegisterValidator;
use Syllashare\Security\Error\Error;
use Syllashare\Core\Controller\CoreController;
/**
 * This class handles all requests related to user authentication
 * i.e. login and register
 * @author Elliot Anderson <elliot@booksmart.it>
 */

class AuthController extends CoreController
{
	/**
	 * @var loginValidator
	 * service to validate the input
	 */
	protected $loginValidator;

	/**
	* @var registerValidator
	* service to validate the registration input
	*/
	protected $registerValidator;

	/**
	 * handleLogin
	 */
	public function handleLogin()
	{
		$this->loginValidator = new LoginValidator();

		$validator = $this->loginValidator->validate();

		if ($validator->failed()) {
			return new Error($validator->getError());
		}

		$input = $validator->getInput();

		$email = $input['email'];
		$password = $input['password'];

		if ($this->attemptLogin($email, $password)) {
			return $this->auth->getUser()->toJson();
		}

		return new Error('Invalid Credentials');
	}

	/**
	 * This method will attempt the login with the credentials
	 * @param 1 -> String email
	 * @param 2 -> String password
	 * @return true or false
	 */
	private function attemptLogin($email, $password)
	{
		if (Auth::attempt(array('email' => $email, 'password' => $password)))
		{
		    $this->auth->refreshUser();

		    return true;
		}

		return false;
	}

	public function handleRegister()
	{
		$this->registerValidator = new RegisterValidator();

		$validator = $this->registerValidator->validate();

		if ($validator->failed()) {
			return new Error($validator->getError());		
		}

		$input = $validator->getInput();

		$valid_email = [];

		$valid = preg_match("/^[a-zA-Z0-9]*@germantownfriends.org/", $input['email'], $valid_email);

		if (!$valid) {
			return new Error("We are only accepting Germantown Friends emails at this time");
		}

		$user = new User;
		$user->first_name = $input['first_name'];
		$user->last_name = $input['last_name'];
		$user->email = $input['email'];
		$user->password = $input['password'];
		$user->auth_key = $input['auth_key'];
		$user->graduating_year = $input['graduating_year'];
		$user->save();

		$input['school']->users()->save($user);

		return json_encode(array('success' => 'User Successfully created!'));    
	}
}
