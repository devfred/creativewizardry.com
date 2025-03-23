<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\SearchController;

Route::get('/', [ContentController::class, 'index']);
Route::get('about',[ContentController::class, 'index']);
Route::get('/{slug}',[ContentController::class, 'detail']);
Route::get('tags/{tag}',[ContentController::class, 'get_content_by_tag']);
Route::get('categories/{category}',[ContentController::class, 'get_content_by_category']);
Route::get('search/{term}', [SearchController::class, 'search']);
Route::post('search', function() {
    $term = Input::get('term');
    if(!$term){
        return Redirect::to("/");
    }
    return Redirect::to("search/$term");
});
