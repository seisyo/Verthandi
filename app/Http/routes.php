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
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', 'LoginController@login');











Route::get('/', function () {
    return view('index');
});

//event
Route::get('/event', function () {
    return view('event');
});
Route::get('/event_diary', function () {
    return view('event_diary');
});
Route::get('/event_ledger', function () {
    return view('event_ledger');
});
Route::get('/event_manage', function () {
    return view('event_manage');
});

//account
Route::get('/account', function () {
    return view('account');
});

//user
Route::get('/users_overview', function () {
    return view('users_overview');
});




