<?php

Route::get('/', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('about', ['as' => 'about', 'uses' => 'AboutController@info']);
Route::get('contact', ['as' => 'contact', 'uses' => 'AboutController@create']);
Route::post('contact',['as' => 'contact_store', 'uses' => 'AboutController@store']);


Route::get('{api}/{content}', 'ContentController@index')
    ->where('api','(?i)api')
    ->where('content','(?i)content');