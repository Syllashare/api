<?php

Route::group(array('namespace' => 'Syllashare\Component\Schedule\Week\Controller', 'prefix' => 'week'), function()
{
	/**
	 * GET the Week Schedule Detail
	 */
	Route::get('/', ['as' => 'schedule.week.get', 'uses' => 'WeekController@get']);
});