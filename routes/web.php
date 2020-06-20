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

Route::get('/', function () {
    return view('auths.login');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index');//->middleware('auth')

    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{id}/edit', 'SiswaController@edit');//url untuk ke form edit data dengan find by id
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');//url untuk hapus data dengan find by id
    Route::patch('/siswa/{id}', 'SiswaController@update');//action untuk simpan data baru dengan berdasarkan id
    Route::delete('/siswa/{id}', 'SiswaController@destroy');//action untuk menghapus data dengan berdasarkan id
    Route::get('/siswa/{id}/profil', 'SiswaController@profil');//action untuk profil data dengan berdasarkan id
});

