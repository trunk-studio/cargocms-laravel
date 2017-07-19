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

// Route::get('/', function () {
//     return view('dashboard');
// });

// Route::get('/login', function () {
// 	return view('login');
// });



Route::get('/','AuthController@index');
Route::get('/login','AuthController@index');

Route::post('/login','AuthController@login');
Route::get('/logout','AuthController@logout');

Route::get('/admin/index','Admin\MainController@index');

Route::get('/admin/SystemMenu','Admin\MenuController@index');
Route::get('/admin/SystemUser','Admin\UserController@index');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
