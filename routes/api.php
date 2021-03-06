<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([
    
    'prefix' => 'v1',
    'namespace'=>'Api',
    'middleware' => 'auth:api',

], function ($router) { 
   
    Route::resource('users', 'UserController')
        ->only(['index','show','store','update','destroy']);

    Route::resource('menus', 'MenuController')
        ->only(['index','show','store','update','destroy']);    

    Route::resource('orders', 'OrderController')
        ->only(['index','show','store','update','destroy']);    
});
