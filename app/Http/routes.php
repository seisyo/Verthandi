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
        'as' => 'view', 'uses' => 'LoginController@check'
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
    Route::group(['as' => 'event::'], function(){
        Route::get('/event', ['as' => 'main', function(){
            return view('event');
        }]);
        Route::get('/event/diary', ['as' => 'diary', function(){
            return view('event_diary');
        }]);
        Route::get('/event/ledger', ['as' => 'ledger', function(){
            return view('event_ledger');
        }]);
        Route::get('/event/manage', ['as' => 'manage', function(){
            return view('event_manage');
        }]);
    });

    //account
    Route::group(['as' => 'account::'], function(){
        Route::get('/account', ['as' => 'main', function(){
            return view('account');
        }]);
    });

    //user
    Route::group(['as' => 'user::'], function(){
        Route::get('/user', [
            'as' => 'main', 'uses' => 'UserController@show'
        ]);
        Route::get('/user/add', [
            'as' => 'add', 'uses' => 'UserController@addUser'
        ]);
        Route::get('/user/edit', [
            'as' => 'edit', 'uses' => 'UserController@editUser'
        ]);
        Route::get('/user/delete', [
            'as' => 'delete', 'uses' => 'UserController@deleteUser'
        ]);
    });

    //password
    Route::group(['as' => 'password::'], function(){
        Route::get('/password',[
            'as' => 'main', 'uses' => 'PasswordController@show'
        ]);
        Route::get('/password/edit',[
            'as' => 'edit', 'uses' => 'PasswordController@edit'
        ]);
    });
    

    //logout
    Route::get('/logout', [
        'as' => 'logout', 'uses' => 'LoginController@logout'
    ]);
});
















