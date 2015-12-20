<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['as' => 'login::'], function(){
    Route::get('/login', [
        'as' => 'main', 'uses' => 'LoginController@check'
    ]);
    Route::post('/login', [
        'as' => 'action', 'uses' => 'LoginController@login'
    ]);
});

Route::group(['middleware' => 'LoginCheck'], function(){

    Route::get('/', ['as' => 'index',function(){
        return view('index');
    }]);

    //event
    Route::group(['as' => 'event::', 'prefix' => 'event'], function(){
        Route::get('/', ['as' => 'main', function(){
            return view('event.main');
        }]);
        Route::get('diary', ['as' => 'diary', function(){
            return view('event.diary');
        }]);
        Route::get('ledger', ['as' => 'ledger', function(){
            return view('event.ledger');
        }]);
        Route::get('manage', ['as' => 'manage', function(){
            return view('event.manage');
        }]);
    });

    //account
    Route::group(['as' => 'account::', 'prefix' => 'account'], function(){
        Route::get('/', [
            'as' => 'main', 'uses' => 'AccountController@show'
        ]);
        Route::get('add', [
            'as' => 'add', 'uses' => 'AccountController@add'
        ]);
        Route::get('edit', [
            'as' => 'edit', 'uses' => 'AccountController@edit'
        ]);
        Route::get('delete', [
            'as' => 'delete', 'uses' => 'AccountController@delete'
        ]);
    });

    //user
    Route::group(['as' => 'user::', 'prefix' => 'user'], function(){
        Route::get('/', [
            'as' => 'main', 'uses' => 'UserController@show'
        ]);
        // Route::get('/user/own/edit', [
        //     'as' => 'user.edit', 'uses' => 'UserController@show'
        // ]);
        Route::get('add', [
            'as' => 'add', 'uses' => 'UserController@addUser'
        ]);
        Route::get('edit', [
            'as' => 'edit', 'uses' => 'UserController@editUser'
        ]);
        Route::get('delete', [
            'as' => 'delete', 'uses' => 'UserController@deleteUser'
        ]);
    });

    //password
    Route::group(['as' => 'password::', 'prefix' => 'password'], function(){
        Route::get('/',[
            'as' => 'main', 'uses' => 'PasswordController@show'
        ]);
        Route::get('edit',[
            'as' => 'edit', 'uses' => 'PasswordController@edit'
        ]);
    });

    //logout
    Route::get('/logout', [
        'as' => 'logout', 'uses' => 'LoginController@logout'
    ]);
});
















