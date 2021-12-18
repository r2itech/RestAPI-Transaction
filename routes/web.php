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
Route::post('/register', 'App\Http\Controllers\CrudController@storeRegistrasi');

//Route Compare
Route::get('/compare/{id}','App\Http\Controllers\CrudController@compare');
Route::post('/compare/{id}','App\Http\Controllers\CrudController@compare');

//Middleware Admin
Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {
    //Route Transaksi
    Route::get('/transaksi', 'App\Http\Controllers\CrudController@transaksi');
    Route::get('/transaksi/create/{id}', 'App\Http\Controllers\PagesController@add');
    Route::post('/transaksi/create', 'App\Http\Controllers\CrudController@storeTransaksi');
    Route::get('/transaksi/update/{id}/{id1}', 'App\Http\Controllers\PagesController@edit');
    Route::post('/transaksi/update/{id}', 'App\Http\Controllers\CrudController@updateTransaksi');
    Route::get('/transaksi/delete/{id}', 'App\Http\Controllers\CrudController@deleteTransaksi');

    //Route Barang
    Route::get('/barang', 'App\Http\Controllers\CrudController@barang');
    Route::get('/barang/create/{id}', 'App\Http\Controllers\PagesController@add');
    Route::post('/barang/create', 'App\Http\Controllers\CrudController@storeBarang');
    Route::get('/barang/update/{id}/{id1}', 'App\Http\Controllers\PagesController@edit');
    Route::post('/barang/update/{id}', 'App\Http\Controllers\CrudController@updateBarang');
    Route::get('/barang/delete/{id}', 'App\Http\Controllers\CrudController@deleteBarang');

    //Route Jenis Barang
    Route::get('/jenisBarang', 'App\Http\Controllers\CrudController@jenisBarang');
    Route::get('/jenisBarang/create/{id}', 'App\Http\Controllers\PagesController@add');
    Route::post('/jenisBarang/create', 'App\Http\Controllers\CrudController@storeJenisBarang');
    Route::get('/jenisBarang/update/{id}/{id1}', 'App\Http\Controllers\PagesController@edit');
    Route::post('/jenisBarang/update/{id}', 'App\Http\Controllers\CrudController@updateJenisBarang');
    Route::get('/jenisBarang/delete/{id}', 'App\Http\Controllers\CrudController@deleteJenisBarang');

    //Route User / api
    Route::get('/api/user/delete/{id}', 'App\Http\Controllers\CrudController@deleteUser');
});

//Middleware Admin and Users
Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    //Route Profil
    Route::get('/profil/{id}/{id1}', 'App\Http\Controllers\PagesController@edit');
    Route::post('/profil/update/{id}', 'App\Http\Controllers\CrudController@updateProfil');

    //Route User / api
    Route::get('/api/{id}', 'App\Http\Controllers\CrudController@api');

    //Route Logout
    Route::get('/logout', 'App\Http\Controllers\CrudController@logout');
});