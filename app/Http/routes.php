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

Route::get('/', 'DashboardController@getIndex');

Route::group(['prefix'=>'auth'],function(){
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
});

Route::group(['prefix'=>'password'],function(){
    Route::get('email', 'Auth\PasswordController@getEmail');
    Route::post('email', 'Auth\PasswordController@postEmail');
    Route::get('reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('reset', 'Auth\PasswordController@postReset');
});

Route::group(['prefix'=>'account'],function(){
    Route::get('/','AccountController@getIndex');
    Route::patch('/','AccountController@patchIndex');
});

Route::group(['prefix'=>'users'],function(){
    Route::get('/','UserController@getIndex');
    Route::get('create','UserController@getCreate');
    Route::put('create','UserController@putCreate');
    Route::get('edit/{userId}','UserController@getUpdate');
    Route::patch('edit/{userId}','UserController@patchUpdate');
    Route::delete('delete/{userId}','UserController@deleteDelete');
});

Route::group(['prefix'=>'clients'],function(){
    Route::get('/','ClientController@getIndex');
    Route::get('create','ClientController@getCreate');
    Route::put('create','ClientController@putCreate');
    Route::get('edit/{clientId}','ClientController@getUpdate');
    Route::patch('edit/{clientId}','ClientController@patchUpdate');
    Route::delete('delete/{clientId}','ClientController@deleteDelete');
});

Route::group(['prefix'=>'statuses'],function(){
    Route::get('/','StatusController@getIndex');
    Route::get('create','StatusController@getCreate');
    Route::put('create','StatusController@putCreate');
    Route::get('edit/{statusId}','StatusController@getUpdate');
    Route::patch('edit/{statusId}','StatusController@patchUpdate');
    Route::delete('delete/{statusId}','StatusController@deleteDelete');
});

Route::group(['prefix'=>'tickets'],function(){
    Route::get('/','TicketController@getIndex');
    Route::get('create','TicketController@getCreate');
    Route::put('create','TicketController@putCreate');
    Route::get('edit/{ticketId}','TicketController@getUpdate');
    Route::patch('edit/{ticketId}','TicketController@patchUpdate');
    Route::delete('delete/{ticketId}','TicketController@deleteDelete');
    Route::get('show/{ticketId}','TicketController@getShow');
    Route::put('edit/{ticketId}/message/create','TicketController@putMessageCreate');
});