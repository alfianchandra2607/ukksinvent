<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
});

// Routes untuk 
Route::resource('barang', \App\Http\Controllers\BarangController::class)->middleware('auth');
Route::resource('profile',\App\Http\Controllers\ProfileController::class)->middleware('auth');
Route::resource('barangmasuk',\App\Http\Controllers\BarangmasukController::class)->middleware('auth');
Route::resource('barangkeluar',\App\Http\Controllers\BarangkeluarController::class)->middleware('auth');
Route::resource('/products', \App\Http\Controllers\ProductController::class)->middleware('auth');
Route::resource('/kategori', \App\Http\Controllers\KategoriController::class)->middleware('auth');
Route::resource('category', \App\Http\Controllers\CategoryController::class);
Route::resource('siswa', \App\Http\Controllers\SiswaController::class)->middleware('auth');
Route::resource('dashboard', \App\Http\Controllers\DashboardController::class)->middleware('auth');



// Routes untuk authentikasi
Route::get('/dashboard', function () {
    return view('layouts.dashboard');
})->middleware('auth')->name('dashboard');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/home', [HomeController::class, 'index']);
    // Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});