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


$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    $api->get('user/{id}', 'UserController@show');
    $api->get('user', 'UserController@index');
    $api->get('user2/{id}', 'UserApiController@getUserInfo');
    $api->get('user2/show/{id}', 'UserApiController@show');
    $api->get('user2', 'UserApiController@index');
    $api->get('user2forpage', 'UserApiController@page');

    $api->post('register', 'Auth\RegisterApiController@register');

    $api->post('login', 'Auth\LoginApiController@login');
});