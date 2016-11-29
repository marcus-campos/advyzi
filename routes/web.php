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

Route::get('/login', function (){
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

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){

        Route::get('/', function (){
           return redirect()->route('admin.dashboard.index');
        });

        //Dashboard
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'DashboardController@index']);
        });

        //Clients
        Route::group(['prefix' => 'contract', 'as' => 'contract.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'CustomerContractsController@index']);
            Route::post('store', ['as' => 'store', 'uses' => 'CustomerContractsController@store']);
            Route::get('destroy/{id}', ['as' => 'delete', 'uses' => 'CustomerContractsController@destroy']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CustomerContractsController@edit']);
            Route::put('update/{id}', ['as' => 'update', 'uses' => 'CustomerContractsController@update']);
        });

        //Customer Contracts

        Route::group(['prefix' => 'customer/contract', 'as' => 'customer.contract.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'ContractsController@index']);
            Route::post('store', ['as' => 'store', 'uses' => 'ContractsController@store']);
            Route::get('destroy/{id}', ['as' => 'delete', 'uses' => 'ContractsController@destroy']);
            Route::get('destroy/{id}/{callBack}', ['as' => 'delete.callback', 'uses' => 'ContractsController@destroy']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ContractsController@edit']);
            Route::get('edit/{id}/{callBack}', ['as' => 'edit.callback', 'uses' => 'ContractsController@edit']);
            Route::put('update/{id}', ['as' => 'update', 'uses' => 'ContractsController@update']);
            Route::get('client/{id}', ['as' => 'client', 'uses' => 'ContractsController@clientContracts']);
            Route::get('client/add/{id}', ['as' => 'add', 'uses' => 'ContractsController@clientAddContracts']);
        });

        //Operator
        Route::group(['prefix' => 'operator', 'as' => 'operator.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'OperatorsController@index']);
            Route::post('store', ['as' => 'store', 'uses' => 'OperatorsController@store']);
            Route::get('destroy/{id}', ['as' => 'delete', 'uses' => 'OperatorsController@destroy']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'OperatorsController@edit']);
            Route::put('update/{id}', ['as' => 'update', 'uses' => 'OperatorsController@update']);
        });

        //User
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'UsersController@index']);
            Route::post('store', ['as' => 'store', 'uses' => 'UsersController@store']);
            Route::get('transfer/{id}', ['as' => 'transfer', 'uses' => 'UsersController@transfer']);
            Route::post('destroy/{id}', ['as' => 'destroy', 'uses' => 'UsersController@destroy']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'UsersController@edit']);
            Route::put('update/{id}', ['as' => 'update', 'uses' => 'UsersController@update']);
            Route::post('password/change', ['as' => 'password.change', 'uses' => 'UsersController@changePassword']);
        });

        //Archives
        Route::group(['prefix' => 'archive', 'as' => 'archive.'], function () {
            Route::get('/{id}', ['as' => 'index', 'uses' => 'ArchivesController@index']);
            Route::post('store/{id}', ['as' => 'store', 'uses' => 'ArchivesController@store']);
            Route::get('destroy/{id}/{contractId}', ['as' => 'destroy', 'uses' => 'ArchivesController@destroy']);
        });
    });
});
