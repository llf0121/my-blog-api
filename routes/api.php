<?php
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
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', [
    'namespace'  => 'App\Http\Controllers',
    'middleware' => ['api'],
    'prefix'     => 'api',
],
    function($api){
        //文章
        $api->group(['namespace' => 'Articles'], function ($api) {
            $api->get('/articles', 'ArticlesController@index')->name('api.articles.index');
            $api->post('/articles', 'ArticlesController@store');
            $api->get('/articles/{article}', 'ArticlesController@show');
            $api->get('/articles/{article}/edit', 'ArticlesController@edit');
            $api->put('/articles/{article}', 'ArticlesController@update');
        });
        //标签
        $api->group(['namespace' => 'Tags'], function ($api) {
            $api->get('/tags', 'TagsController@index');
            $api->post('/tags', 'TagsController@store');
        });

    }
);



