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



//WEB
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
        Route::get('/', [
            'as' => 'main', 'uses' => 'EventController@showEventMain'
        ]);
        Route::get('diary', ['as' => 'diary', function(){
            return view('event.diary');
        }]);
        Route::get('ledger', ['as' => 'ledger', function(){
            return view('event.ledger');
        }]);

        Route::post('add',[
            'as' => 'add', 'uses' => 'EventController@addEvent'
        ]);
        Route::post('edit',[
            'as' => 'edit', 'uses' => 'EventController@editEvent'
        ]);
        Route::post('delete',[
            'as' => 'delete', 'uses' => 'EventController@deleteEvent'
        ]);
        
    });
    //event manage
    Route::get('event/manage', [
        'as' => 'event::manage', 'uses' => 'EventController@showEventManage'
    ]);

    //account
    Route::group(['as' => 'account::', 'prefix' => 'account'], function(){
        Route::get('/', [
            'as' => 'main', 'uses' => 'AccountController@showAccount'
        ]);
        Route::post('add', [
            'as' => 'add', 'uses' => 'AccountController@addAccount'
        ]);
        Route::post('edit', [
            'as' => 'edit', 'uses' => 'AccountController@editAccount'
        ]);
        Route::post('delete', [
            'as' => 'delete', 'uses' => 'AccountController@deleteAccount'
        ]);

        //API
        Route::get('/search/all', [
            'as' => 'searchAll', 'uses' => 'AccountController@searchAllAccount'
        ]);
        Route::get('/search/id', [
            'as' => 'searchById', 'uses' => 'AccountController@searchByIdAccount'
        ]);
    });

    //user 
    Route::group(['as' => 'user::', 'prefix' => 'user'], function(){
        Route::get('/', [
            'as' => 'main', 'uses' => 'UserController@showUser'
        ]);
        // Route::get('/user/own/edit', [
        //     'as' => 'user.edit', 'uses' => 'UserController@show'
        // ]);
        Route::post('add', [
            'as' => 'add', 'uses' => 'UserController@addUser'
        ]);
        Route::post('edit', [
            'as' => 'edit', 'uses' => 'UserController@editUser'
        ]);
        Route::post('disable', [
            'as' => 'disable', 'uses' => 'UserController@disableUser'
        ]);
        Route::post('activate', [
            'as' => 'activate', 'uses' => 'UserController@activateUser'
        ]);
        Route::post('delete', [
            'as' => 'delete', 'uses' => 'UserController@deleteUser'
        ]);
        //API
        Route::get('/search/all', [
            'as' => 'searchAll', 'uses' => 'UserController@searchAllUser'
        ]);
        Route::get('/search/id', [
            'as' => 'searchById', 'uses' => 'UserController@searchByIdUser'
        ]);
    });

    //password
    Route::group(['as' => 'password::', 'prefix' => 'password'], function(){
        Route::get('/',[
            'as' => 'main', 'uses' => 'PasswordController@show'
        ]);
        Route::post('edit',[
            'as' => 'edit', 'uses' => 'PasswordController@edit'
        ]);
    });

    //logout
    Route::get('/logout', [
        'as' => 'logout', 'uses' => 'LoginController@logout'
    ]);

});
















