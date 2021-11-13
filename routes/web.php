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

Auth::routes([
    'register' => false, 
    'verify' => false, 
  ]);

Route::get('/loggedin', 'HomeController@apps');
Route::get('/loggedout', 'HomeController@apps');

Route::middleware(['auth', 'auth-check'])->group(function () {

    Route::get('/', 'HomeController@apps')->name('home');
    Route::get('/{any}', 'HomeController@apps')->where('app', '.*');
});