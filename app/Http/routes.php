<?php
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('about', ['as' => 'about', 'uses' => 'AboutController@info']);
Route::get('contact', ['as' => 'contact', 'uses' => 'AboutController@create']);
Route::post('contact',['as' => 'contact_store', 'uses' => 'AboutController@store']);
Route::post('newsletter/signup', 'NewsletterController@signup');

Route::get('{api}/{content}', 'ContentController@index')->where('api','(?i)api')->where('content','(?i)content');
Route::get('{api}/{content}/create', 'ContentController@create')->where('api','(?i)api')->where('content','(?i)content');
Route::post('{api}/{content}', 'ContentController@store')->where('api','(?i)api')->where('content','(?i)content');

Route::get('tags', 'TagsController@index');
Route::get('tags/{slug}', 'TagsController@show');
Route::post('{api}/{tag}', 'TagsController@store')->where('api','(?i)api')->where('tag','(?i)tag');

Route::get('categories', 'CategoriesController@index');
Route::get('categories/{slug}', 'CategoriesController@show');
Route::post('{api}/{category}', 'CategoriesController@store')->where('api','(?i)api')->where('category','(?i)category');

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