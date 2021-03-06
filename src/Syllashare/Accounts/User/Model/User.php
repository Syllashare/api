<?php

namespace Syllashare\Accounts\User\Model;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Eloquent;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * getSchool() to get the school
	 */
	public function getSchool()
	{
		return $this->school;
	}

	/**
	 * define the user->school relationship (belongsTo)
	 */
	public function school()
	{
		return $this->belongsTo('Syllashare\Component\School\Model\School');
	}

	public function periods()
	{
		return $this->belongsToMany('Syllashare\Component\Period\Model\Period');
	}

}
