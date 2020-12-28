<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware'=>['auth','can:admin_auth']],function(){
    Route::get('permit', 'Admin\ManageController@manage');
    Route::post('permit', 'Admin\ManageController@update');
    Route::get('result', 'Admin\ManageController@result');
});


Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
    Route::get('offer', 'Admin\UserController@applyIndex');
    Route::post('offer', 'Admin\UserController@restApply');
    Route::get('create', 'Admin\UserController@createIndex');
    Route::post('create', 'Admin\UserController@create');
    Route::get('edit', 'Admin\UserController@edit');
    Route::post('edit', 'Admin\UserController@update');
    Route::get('calendar', 'Admin\UserController@listView');
    Route::post('calendar', 'Admin\UserController@listEdit');
    Route::post('csv', 'Admin\UserController@csvExport');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

