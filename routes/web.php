<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'user', 'middleware'=>'auth.jwt'], function () use ($router){    

    $router->post('/signup/{provider?}', 'UserController@signup');  # 회원가입
    $router->post('/signin/{provider?}', 'UserController@signin');  # 로그인
    $router->get('/logout', 'UserController@logout');               # 로그아웃
    $router->get('/{uuid?}', 'UserController@info');                # 유저정보
    $router->put('/{uuid?}', 'UserController@update');              # 유저정보 수정
    $router->delete('/signout', 'UserController@signout');          # 회원 탈퇴

});