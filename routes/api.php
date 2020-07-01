<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//文章
Route::namespace('Articles')->group(function (){
    Route::get('/articles','ArticlesController@index');
    Route::post('/articles','ArticlesController@store');
});

//标签
Route::namespace('Tags')->group(function (){
    Route::get('/tags','TagsController@index');
    Route::post('/tags','TagsController@store');
});
