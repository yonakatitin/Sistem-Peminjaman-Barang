<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/unit', 'App\Http\Controllers\UnitController@index');
// Route::get('/unit/barang/{id}', 'App\Http\Controllers\UnitController@barang');
// Route::get('/barang/show/{id}', 'App\Http\Controllers\BarangController@show');
Route::get('/units', 'App\Http\Controllers\UnitController@index')->name('units.index');
Route::get('/units/{unit}', 'App\Http\Controllers\UnitController@show')->name('units.show');
Route::get('/barang/{detailbarang}', 'App\Http\Controllers\BarangController@show')->name('barang.show');


// Route::post('/pinjam', [RequestpeminjamanController::class, 'store'])->name('pinjam.store');
// Route::get('/pinjam/{barang}', [RequestpeminjamanController::class, 'create'])->name('pinjam.create');
// Route::get('/pinjam/{id}', 'App\Http\Controllers\RequestpeminjamanController@show')->name('pinjam.show');
// Route::get('/pinjam', [RequestpeminjamanController::class, 'index'])->name('pinjam.index');

Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');
Route::get('/pinjam/{barang}', [PeminjamanController::class, 'create'])->name('pinjam.create');
Route::get('/pinjam/{id}', 'App\Http\Controllers\PeminjamanController@show')->name('pinjam.show');
Route::get('/pinjam', [PeminjamanController::class, 'index'])->name('pinjam.index');
Route::get('/pinjam/{id}/cetak', [PeminjamanController::class, 'cetak'])->name('pinjam.cetak');
Route::post('/pinjam/print', [PeminjamanController::class, 'print'])->name('pinjam.print');



Route::post('/search', [HomeController::class, 'searchBarang'])->name('search');



Route::get('/profile/edit', [UsersController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [UsersController::class, 'update'])->name('profile.update');
// Route::get('/profile/pwd', [UsersController::class, 'pwd'])->name('profile.pwd');


Route::group(['middleware' => 'web'], function () {
    // Rute-rute yang terkait dengan form peminjaman
});


// Route::get('/pinjam/tambah', 'App\Http\Controllers\RequestpeminjamanController@tambah');
// Route::post('/pinjam/store', 'App\Http\Controllers\RequestpeminjamanController@store');

Route::get('/unit/edit/{id}', 'App\Http\Controllers\UnitController@edit');
Route::get('/unit/hapus/{id}','App\Http\Controllers\UnitController@hapus');
Route::get('/unit/create','App\Http\Controllers\UnitController@create');
Route::post('/unit/store','App\Http\Controllers\UnitController@store');

// Route::resource('kategori', 'KategoriController');
// Route::resource('barang', 'BarangController');
// Route::resource('detailbarang', 'DetailbarangController');
// Route::resource('peminjaman', 'PeminjamanController');
// Route::resource('adminunit', 'AdminunitController');
// Route::resource('administrator', 'AdministratorController');
// Route::resource('users', 'UsersController');

Auth::routes();

Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth', 'user-access:adminunit'])->group(function () {
  
    Route::get('/adminunit/home', [App\Http\Controllers\HomeController::class, 'adminunitHome'])->name('adminunit.home');
});
  
Route::middleware(['auth', 'user-access:administrator'])->group(function () {
  
    Route::get('/administrator/home', [App\Http\Controllers\HomeController::class, 'administratorHome'])->name('administrator.home');
});