<?php

Route::group(array('namespace' => 'Syllashare\Component\Period\Controller', 'prefix' => 'period'), function()
{
	/**
	 * POST add
	 */
	Route::post('/add', ['as' => 'user.period.add', 'uses' => 'PeriodController@add']);
});