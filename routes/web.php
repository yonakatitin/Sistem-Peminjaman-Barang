<?php

use App\Http\Controllers\UnitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;
use App\Models\Barang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/reset-pass', function () {
    return view('email.forgetPassword');
})->name('reset-pass');

// register admin unit
Route::get('register/adminunit', 'App\Http\Controllers\Auth\ReqadminunitController@index')->name('register.adminunit');
Route::post('register/adminunit/store', 'App\Http\Controllers\Auth\ReqadminunitController@register')->name('register.adminunit.store');

// forgot & reset
Route::get('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
Route::post('forget-password', 'App\Http\Controllers\Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post'); 
Route::get('reset-password/{token}', 'App\Http\Controllers\Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'App\Http\Controllers\Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

Route::group(['middleware' => 'web'], function () {
    // Rute-rute yang terkait dengan form peminjaman
});

// auth
Auth::routes();

Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/units', 'App\Http\Controllers\UnitController@index')->name('units.index');
    Route::get('/units/{unit}', 'App\Http\Controllers\UnitController@show')->name('units.show');
    Route::get('/barang/{detailbarang}', 'App\Http\Controllers\BarangController@show')->name('barang.show');

    Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');
    Route::get('/pinjam/{barang}', [PeminjamanController::class, 'create'])->name('pinjam.create');
    Route::get('/pinjam/{id}', 'App\Http\Controllers\PeminjamanController@show')->name('pinjam.show');
    Route::get('/pinjam', [PeminjamanController::class, 'index'])->name('pinjam.index');
    Route::get('/pinjam/{id}/cetak', [PeminjamanController::class, 'cetak'])->name('pinjam.cetak');
    Route::post('/pinjam/print', [PeminjamanController::class, 'print'])->name('pinjam.print');

    Route::post('/search', [HomeController::class, 'searchBarang'])->name('search');

    Route::get('/profile/edit', [UsersController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [UsersController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'user-access:adminunit'])->group(function () {

    Route::get('get/peminjaman', 'App\Http\Controllers\PeminjamanController@getData')->name('get.peminjaman');
    Route::get('get/barang', 'App\Http\Controllers\BarangController@getData')->name('get.barang');
  
    Route::get('adminunit/dashboard', [App\Http\Controllers\HomeController::class, 'adminunitHome'])->name('adminunit.dashboard');

        // barang
        Route::get('adminunit/barang', 'App\Http\Controllers\BarangController@index')->name('adminunit.barang');
        Route::get('adminunit/barang/edit/{id_barang}', 'App\Http\Controllers\BarangController@edit')->name('adminunit.barang.edit');
        Route::post('/adminunit/barang/update', 'App\Http\Controllers\BarangController@update')->name('adminunit.barang.update');
        Route::get('adminunit/barang/create', 'App\Http\Controllers\BarangController@create')->name('adminunit.barang.create');
        Route::get('adminunit/barang/hapus/{id_barang}','App\Http\Controllers\BarangController@hapus')->name('adminunit.barang.hapus');
        Route::post('adminunit/barang/store','App\Http\Controllers\BarangController@store')->name('adminunit.barang.store');
    
        // req peminjaman
        Route::resource('adminunit/reqpeminjaman', 'App\Http\Controllers\RequestpeminjamanController')->names([
            'index' => 'adminunit.reqpeminjaman',
        ]);
        Route::get('adminunit/reqpeminjaman/approve/{id_reqpeminjaman}', 'App\Http\Controllers\PeminjamanController@approve')->name('adminunit.reqpeminjaman.approve');
        Route::get('adminunit/reqpeminjaman/create', 'App\Http\Controllers\PeminjamanController@admin_create')->name('adminunit.reqpeminjaman.create');
        Route::get('adminunit/reqpeminjaman/decline/{id_reqpeminjaman}','App\Http\Controllers\PeminjamanController@decline')->name('adminunit.reqpeminjaman.decline');
        Route::post('adminunit/reqpeminjaman/store','App\Http\Controllers\PeminjamanController@admin_store')->name('adminunit.reqpeminjaman.store');

        // peminjaman
        Route::get('adminunit/peminjaman', 'App\Http\Controllers\PeminjamanController@admin_index')->name('adminunit.peminjaman');
        // Route::get('adminunit/peminjaman/create', 'App\Http\Controllers\PeminjamanController@create')->name('adminunit.peminjaman.create');
        Route::get('adminunit/peminjaman/returned/{id_peminjaman}','App\Http\Controllers\PeminjamanController@returned')->name('adminunit.peminjaman.returned');
        Route::get('adminunit/peminjaman/borrowed/{id_peminjaman}','App\Http\Controllers\PeminjamanController@borrowed')->name('adminunit.peminjaman.borrowed');
        // Route::post('adminunit/peminjaman/store','App\Http\Controllers\PeminjamanController@store')->name('adminunit.peminjaman.store');

        // profile
        Route::get('adminunit/profile', 'App\Http\Controllers\AdminunitController@show_profile')->name('adminunit.profile');
        Route::get('adminunit/profile/edit', 'App\Http\Controllers\AdminunitController@edit_profile')->name('adminunit.profile.edit');
        Route::post('adminunit/profile/update', 'App\Http\Controllers\AdminunitController@update_profile')->name('adminunit.profile.update');

        // change password
        Route::get('adminunit/change-password', 'App\Http\Controllers\AdminunitController@change_password')->name('adminunit.change-password');
        Route::post('adminunit/change-password', 'App\Http\Controllers\AdminunitController@update_password')->name('adminunit.update-password');


});
  
Route::middleware(['auth', 'user-access:administrator'])->group(function () {

    Route::get('get/reqadminunit', 'App\Http\Controllers\Reqadminunit2Controller@getData')->name('get.reqadminunit');
    Route::get('get/users', 'App\Http\Controllers\UserController@getData')->name('get.users');
  
    Route::get('admin/dashboard', [App\Http\Controllers\HomeController::class, 'administratorHome'])->name('admin.dashboard');

    // unit
    Route::get('admin/unit', 'App\Http\Controllers\UnitController@admin_index')->name('admin.unit');
    Route::get('admin/unit/edit/{id}', 'App\Http\Controllers\UnitController@edit')->name('admin.unit.edit');
    Route::post('admin/unit/update', 'App\Http\Controllers\UnitController@update')->name('admin.unit.update');
    Route::get('admin/unit/create', 'App\Http\Controllers\UnitController@create')->name('admin.unit.create');
    Route::get('admin/unit/hapus/{id}','App\Http\Controllers\UnitController@hapus')->name('admin.unit.hapus');
    Route::post('admin/unit/store','App\Http\Controllers\UnitController@store')->name('admin.unit.store');

    // kategori
    Route::resource('admin/kategori', 'App\Http\Controllers\KategoriController')->names([
        'index' => 'admin.kategori',
    ]);
    Route::get('admin/kategori/edit/{id}', 'App\Http\Controllers\KategoriController@edit')->name('admin.kategori.edit');
    Route::post('admin/kategori/update', 'App\Http\Controllers\KategoriController@update')->name('admin.kategori.update');
    Route::get('admin/kategori/create', 'App\Http\Controllers\KategoriController@create')->name('admin.kategori.create');
    Route::get('admin/kategori/hapus/{id}','App\Http\Controllers\KategoriController@hapus')->name('admin.kategori.hapus');
    Route::post('admin/kategori/store','App\Http\Controllers\KategoriController@store')->name('admin.kategori.store');

    // user
    Route::resource('admin/user', 'App\Http\Controllers\UserController')->names([
        'index' => 'admin.user',
    ]);
    Route::get('admin/user/edit/{id}', 'App\Http\Controllers\UserController@admin_edit')->name('admin.user.edit');
    Route::post('admin/user/update', 'App\Http\Controllers\UserController@admin_update')->name('admin.user.update');
    Route::get('admin/user/create', 'App\Http\Controllers\UserController@create')->name('admin.user.create');
    Route::get('admin/user/hapus/{id}','App\Http\Controllers\UserController@hapus')->name('admin.user.hapus');
    Route::post('admin/user/store','App\Http\Controllers\UserController@store')->name('admin.user.store');

    // adminunit
    Route::resource('admin/adminunit', 'App\Http\Controllers\AdminunitController')->names([
        'index' => 'admin.adminunit',
    ]);
    Route::get('admin/adminunit/edit/{id}', 'App\Http\Controllers\AdminunitController@edit')->name('admin.adminunit.edit');
    Route::post('admin/adminunit/update', 'App\Http\Controllers\AdminunitController@update')->name('admin.adminunit.update');
    Route::get('admin/adminunit/create', 'App\Http\Controllers\AdminunitController@create')->name('admin.adminunit.create');
    Route::get('admin/adminunit/hapus/{id}','App\Http\Controllers\AdminunitController@hapus')->name('admin.adminunit.hapus');
    Route::post('admin/adminunit/store','App\Http\Controllers\AdminunitController@store')->name('admin.adminunit.store');

    // reqadminunit
    Route::resource('admin/reqadminunit', 'App\Http\Controllers\Reqadminunit2Controller')->names([
        'index' => 'admin.reqadminunit',
    ]);
    Route::get('admin/reqadminunit/approve/{id}', 'App\Http\Controllers\Reqadminunit2Controller@approve')->name('admin.reqadminunit.approve');
    Route::get('admin/reqadminunit/decline/{id}', 'App\Http\Controllers\Reqadminunit2Controller@decline')->name('admin.reqadminunit.decline');
    Route::get('admin/reqadminunit/create', 'App\Http\Controllers\Reqadminunit2Controller@create')->name('admin.reqadminunit.create');
    Route::get('admin/reqadminunit/delete/{id}','App\Http\Controllers\Reqadminunit2Controller@hapus')->name('admin.reqadminunit.hapus');
    Route::post('admin/reqadminunit/store','App\Http\Controllers\Reqadminunit2Controller@store')->name('admin.reqadminunit.store');
    Route::get('admin/reqadminunit/sendemail/{id}','App\Http\Controllers\EmailadminunitController@index')->name('admin.reqadminunit.sendemail');

    // profile
    Route::get('admin/profile', 'App\Http\Controllers\AdministratorController@index')->name('admin.profile');
    Route::get('admin/profile/edit', 'App\Http\Controllers\AdministratorController@edit')->name('admin.profile.edit');
    Route::post('admin/profile/update', 'App\Http\Controllers\AdministratorController@update')->name('admin.profile.update');

    // change password
    Route::get('admin/change-password', 'App\Http\Controllers\AdministratorController@change_password')->name('admin.change-password');
    Route::post('admin/change-password', 'App\Http\Controllers\AdministratorController@update_password')->name('admin.update-password');
});
