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

Auth::routes();

// route active user register
Route::get('/active/{id}/{token}', 'Auth\RegisterController@activeUser')->name('user.active');


// routes Main Application
Route::get('/main', 'MainController@index');
Route::get('/main/profile', 'MainController@profile');
Route::get('/main/auth', 'MainController@auth');
Route::post('/main/save-auth', 'MainController@saveAuth');
Route::post('/main/upload-file', 'MainController@uploadFile');
Route::post('/main/save-profile', 'MainController@saveProfile');

// routes Test Application
Route::get('/test', 'TestController@index');
Route::get('/test/get-profile', 'TestController@getProfile');
Route::post('/test/check-email', 'TestController@checkEmail');
Route::get('/test/check-auth', 'TestController@checkAuth');
