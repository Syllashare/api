<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

function routes_path() {
	return base_path() .'/src/Syllashare/Resources/Http/routes';
}

Route::get('/', function()
{
	return View::make('hello');
});

/**
 * auth routes
 */

require routes_path(). '/Auth/auth.php';

/**
 * schedule routes
 */

require routes_path(). '/Schedule/schedule.php';

/**
 * period routes
 */
 
 require routes_path(). '/Period/period.php';