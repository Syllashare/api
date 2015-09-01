<?php

Route::group(array('namespace' => 'Syllashare\Component\Period\Model\Period', 'prefix' => 'period'), function()
{
	/**
	 * POST add
	 */
	Route::post('/add', ['as' => 'user.period.add', 'PeriodController@add']);
});