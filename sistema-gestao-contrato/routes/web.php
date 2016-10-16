<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function (){
    return Redirect::to(route('auth.login'));
});

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function (){
    // Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    // Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
});

Route::group(['prefix' => 'password', 'as' => 'password.'], function (){
    // Password Reset Routes...
    Route::get('reset', ['as' => 'reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('email', ['as' => 'email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);

    Route::group(['prefix' => 'reset', 'as' => 'reset.'], function () {
        Route::post('/', ['as' => 'post', 'uses' => 'Auth\ResetPasswordController@reset']);
        Route::get('reset/{token}', ['as' => 'token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    });
});
