<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SearchController;

Route::get('/', [ContentController::class, 'index']);
Route::get('about', function () {    
    return (new ContentController)->get_static_content('about');
});
Route::get('/{slug}',[ContentController::class, 'get_content_by_slug']);
Route::get('tags/{tagSlug}',[ContentController::class, 'get_content_by_tag']);
Route::get('categories/{categorySlug}',[ContentController::class, 'get_content_by_category']);
Route::get('search/{term}', [SearchController::class, 'search']);
Route::post('search', function() {
    $term = Input::get('term');
    if(!$term){
        return Redirect::to("/");
    }
    return Redirect::to("search/$term");
});
