<?php
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// admin routes
Route::get('{admin}', 'AdminController@index')->where('admin','(?i)admin');
Route::group(array('prefix' => 'admin'), function(){
    Route::resource('content', 'ContentController');
    Route::resource('tags', 'TagsController');
    Route::resource('categories', 'CategoriesController');
});

// public routes
Route::get('about', ['as' => 'about', 'uses' => 'AboutController@info']);
Route::get('contact', ['as' => 'contact', 'uses' => 'AboutController@create']);
Route::post('contact',['as' => 'contact_store', 'uses' => 'AboutController@store']);
Route::post('newsletter/signup', 'NewsletterController@signup');

Route::get('tags', 'TagsController@index');
Route::get('tags/{slug}', 'TagsController@show');

Route::get('categories', 'CategoriesController@index');
Route::get('categories/{slug}', 'CategoriesController@show');

Route::get('search/{term}', 'SearchController@search');
Route::post('search', function() {
    $term = Input::get('term');
    if(!$term){
        return Redirect::to("/");
    }
    return Redirect::to("search/$term");
});

Route::get('/', 'ContentController@index');
Route::get('/{slug}', 'ContentController@show');

