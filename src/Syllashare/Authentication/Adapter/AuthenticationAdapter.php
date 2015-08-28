<?php

namespace Syllashare\Authentication\Adapter;

use Auth;

class AuthenticationAdapter
{
	/**
	 * instance of the currentUser
	 */
	protected $currentUser;

	/**
	 * instantiate the current logged in user
	 */
	public function __construct()
	{
		$this->currentUser = Auth::user();
	}		

	/**
	 * @return User object
	 */
	public function getUser()
	{
		return $this->currentUser;
	}

	public function refreshUser()
	{
		$this->currentUser = Auth::user();
	}

	public function check()
	{
		return Auth::check();
	}
}