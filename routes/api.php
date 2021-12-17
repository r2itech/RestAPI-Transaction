<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('get-transaksi', 'App\Http\Controllers\Api\ApiTransaksiController@getTransaksi');
Route::get('get-barang', 'App\Http\Controllers\Api\ApiTransaksiController@getBarang');
Route::get('get-jenis-barang', 'App\Http\Controllers\Api\ApiTransaksiController@getJenisBarang');
