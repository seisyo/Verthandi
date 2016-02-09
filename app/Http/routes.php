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

    Route::get('/', [
        'as' => 'index', 'uses' => 'LoginController@showIndex'
    ]);


    //event
    Route::group(['as' => 'event::', 'prefix' => 'event'], function(){
        
        // Event Manage
        Route::group(['as' => 'manage::', 'prefix' => 'manage', 'middleware' => 'EventManagePagePermission'], function(){

            Route::get('main', [
                'as' => 'main', 'uses' => 'EventController@showEventManage'
            ]);
            Route::post('add',[
                'as' => 'add', 'uses' => 'EventController@addEvent'
            ]);
            Route::post('edit',[
                'as' => 'edit', 'uses' => 'EventController@editEvent'
            ]);
            Route::post('delete',[
                'as' => 'delete', 'uses' => 'EventController@deleteEvent'
            ]);
            
            //API
            Route::get('/search/all', [
                'as' => 'searchAll', 'uses' => 'EventController@searchAllEvent'
            ]);
            Route::get('/search/id', [
                'as' => 'searchById', 'uses' => 'EventController@searchByIdEvent'
            ]);
        });
        
        // Diary
        Route::get('{eventId}/diary',[
            'as' => 'diary', 'uses' => 'DiaryController@showEventDiary'
        ]);
        Route::get('diary/file/downloader/{fileName}/', [
            'as' => 'diary/file/downloader', 'uses' => 'DiaryController@downloadAttachedFile'
        ]);
        Route::group(['middleware' => 'DiaryPagePermission'], function(){
            
            Route::post('{eventId}/diary/add',[
            'as' => 'diary/add', 'uses' => 'DiaryController@addEventDiary'
            ]);
            Route::post('{eventId}/diary/edit',[
                'as' => 'diary/edit', 'uses' => 'DiaryController@editEventDiary'
            ]);
            Route::post('{eventId}/diary/delete',[
                'as' => 'diary/delete', 'uses' => 'DiaryController@deleteEventDiary'
            ]);
            // diary API
            Route::get('diary/file/deleter', [
                'as' => 'diary/file/deleter', 'uses' => 'DiaryController@deleteAttachedFile'
            ]);
        });

        // Ledger
        Route::get('{eventId}/ledger', [
            'as' => 'ledger', 'uses' => 'LedgerController@showEventLedger'
        ]);
        // ledger API
        Route::get('{eventId}/ledger/account/record/search', [
            'as' => 'ledger/account/record/search', 'uses' => 'LedgerController@accountRecordSearch'
        ]);

        //every event
        Route::get('{eventId}/main', [
            'as' => 'main', 'uses' => 'EventController@showEventMain'
        ]);
    });


    // Account
    Route::group(['as' => 'account::', 'prefix' => 'account', 'middleware' => 'AccountPagePermission'], function(){
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
        Route::get('/search/nextId',[
            'as' => 'searchNextIdByParentId', 'uses' => 'AccountController@searchNextIdByParentId'
        ]);
    });


    // User 
    Route::group(['as' => 'user::', 'prefix' => 'user', 'middleware' => 'UserPagePermission'], function(){
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


    //Password
    Route::group(['as' => 'password::', 'prefix' => 'password'], function(){
        Route::get('/',[
            'as' => 'main', 'uses' => 'PasswordController@show'
        ]);
        Route::post('edit',[
            'as' => 'edit', 'uses' => 'PasswordController@edit'
        ]);
    });


    //Logout
    Route::get('/logout', [
        'as' => 'logout', 'uses' => 'LoginController@logout'
    ]);

});
















