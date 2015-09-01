<?php

namespace Syllashare\Component\School\Model;

use Eloquent;

/**
 * A school is just the basic collection of students, and is the super class
 * for all child event-based information (years, daySchedules, etc)
 */

class School extends Eloquent
{
	/**
	 * hasMany users
	 */
	public function users()
	{
		return $this->hasMany('Syllashare\Accounts\User\Model\User');
	}

	/**
	 * hasMany years
	 */
	public function years()
	{
		return $this->hasMany('Syllashare\Component\Date\Year\Model\Year');
	}

	/**
	 * getEmailDomain()
	 */
	public function getEmailDomain()
	{
		return $this->email_domain;
	} 

	/**
	 * getter for years relationship
	 */
	public function getYears()
	{
		return $this->years;
	}
}	