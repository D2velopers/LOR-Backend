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

$router->group(['prefix' => 'user'], function () use ($router){    
$router->post('/signin', 'Auth\UserController@authenticate');  # 로그인
$router->post('/signup', 'Auth\UserController@signup');        # 회원가입
$router->get('/verification', 'Auth\UserController@emailverification'); # 메일인증
});

$router->group(['prefix' => 'user', 'middleware'=>'jwt.auth'], function () use ($router){    
    $router->post('/logout', 'Auth\UserController@logout');               # 로그아웃
    $router->get('/{uuid?}', 'Auth\UserController@info');                # 유저정보
    $router->put('/{uuid?}', 'Auth\UserController@update');              # 유저정보 수정
    $router->delete('/signout', 'Auth\UserController@signout');          # 회원 탈퇴

$router->group(['prefix' => '{lan?}'], function () use ($router) {
    $router->group(['prefix' => 'decks'], function () use ($router) {
        $router->post('/share', 'DeckController@share');
    });
});
