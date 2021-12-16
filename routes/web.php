<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function(){
//     return view('welcome');
// });

//Route Home
Route::get('/', 'App\Http\Controllers\CrudController@home');

//Foute Forbidden
Route::get('/forbidden/{id}', 'App\Http\Controllers\PagesController@forbidden')->name('forbidden');

//Route Login
Route::get('/login/{id}', 'App\Http\Controllers\PagesController@pages');
Route::post('/login', 'App\Http\Controllers\CrudController@login');

//Route Register
Route::get('/register/{id}', 'App\Http\Controllers\PagesController@pages');

//Middleware Admin
Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {

});

//Middleware Admin and Users
Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    
    //Route Logout
    Route::get('/logout', 'App\Http\Controllers\CrudController@logout');
});