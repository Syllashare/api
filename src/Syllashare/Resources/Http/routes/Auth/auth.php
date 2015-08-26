<?php

Route::group(array('namespace' => 'Syllashare\Authentication\Controller'), function()
{
	Route::post('/login', 'AuthController@handleLogin');

	Route::post('/register', 'AuthController@handleRegister');
});