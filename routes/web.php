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


Auth::routes();

Route::get('/', array('as' => 'home_page' ,'uses' => 'admin\DashboardController@index'));
Route::get('/test', array('as' => 'test' ,'uses' => 'admin\UserController@test'));
Route::get('/home', array('as' => 'home_page' ,'uses' => 'admin\DashboardController@redirectToSite'));
Route::get('/dashboard', array('as' => 'super.admin.dashboard' ,'uses' => 'admin\DashboardController@index'));

/***********************************************************/
//user routes
/**********************************************************/

Route::get('/users', array('as' => 'users.list' ,'uses' => 'admin\UserController@index'));
Route::post('/get/users', array('as' => 'users.get' ,'uses' => 'admin\UserController@getUsers'));
Route::get('/user/create/', array('as' => 'user.create' ,'uses' => 'admin\UserController@create'));
Route::get('/user/edit/{id?}', array('as' => 'user.edit' ,'uses' => 'admin\UserController@edit'));
Route::post('/user/add/', array('as' => 'user.add' ,'uses' => 'admin\UserController@store'));
Route::post('/user/delete/', array('as' => 'user.delete' ,'uses' => 'admin\UserController@destroy'));
Route::post('/user/upload/image', array('as' => 'user.upload.image' ,'uses' => 'admin\UserController@uploadImage'));


/***********************************************************/
//file routes
/**********************************************************/

Route::get('/files', array('as' => 'files.list' ,'uses' => 'admin\DashboardController@index'));
Route::post('/get/files', array('as' => 'files.get' ,'uses' => 'admin\DashboardController@getFiles'));
Route::post('/file/delete/', array('as' => 'file.delete' ,'uses' => 'admin\DashboardController@destroy'));
Route::post('/upload/file', array('as' => 'upload.file' ,'uses' => 'admin\DashboardController@uploadFile'));
Route::get('/download/file/{id?}', array('as' => 'download.file' ,'uses' => 'admin\DashboardController@downloadFile'));

