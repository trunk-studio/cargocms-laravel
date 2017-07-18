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



Route::get('/','AuthController@login');
Route::post('/login','AuthController@postLogin');
Route::get('/logout','AuthController@logout');

Route::get('/dashboard','BoardController@index');
Route::get('/user','UserController@index');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
