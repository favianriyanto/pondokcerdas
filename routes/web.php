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
    return redirect('/beranda');
});

Auth::routes();

Route::get('/beranda', 'HomeController@index')->name('home');

Route::post('/usergantipass', 'MasterController@usergantipass');

//buku
Route::get('/buku', 'MasterController@buku');
Route::get('/bukuhapus/{id}', 'MasterController@bukuhapus');
Route::get('/bukuget/{id}', 'MasterController@bukuget');
Route::post('/bukutambah', 'MasterController@bukutambah');
Route::post('/bukuedit', 'MasterController@bukuedit');

//peminjam
Route::get('/peminjam', 'MasterController@peminjam');
Route::get('/peminjamhapus/{id}', 'MasterController@peminjamhapus');
Route::get('/peminjamget/{id}', 'MasterController@peminjamget');
Route::post('/peminjamtambah', 'MasterController@peminjamtambah');
Route::post('/peminjamedit', 'MasterController@peminjamedit');

//transaksi
Route::post('/transaksitambah', 'MasterController@transaksitambah');
Route::get('/transaksikembali/{id}', 'MasterController@transaksikembali');
Route::get('/riwayat','MasterController@riwayat');
