<?php

namespace Syllashare\Core\Controller;

use BaseController;
use Syllashare\Authentication\Adapter\AuthenticationAdapter;

/**
 * This class will be the first parent of all syllashare controllers
 * It will allow for easy use of authentication adapter 
 * @author Elliot Anderson <elliot@syllashare.com>
 */
class CoreController extends BaseController
{
	/**
	 * instance of the authenticator. 
	 */
	protected $auth;	

	/**
	 * Laravel will automatically instantiate the AuthenticationAdapter for us
	 * @see docs for more
	 */
	public function __construct(AuthenticationAdapter $authenticationAdapter)
	{
		$this->auth = $authenticationAdapter;
	}
}