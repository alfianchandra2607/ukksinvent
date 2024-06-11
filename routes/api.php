<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
//ini untuk login
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/showkategori', [KategoriController::class, 'showAPIKategori']);
Route::post('editkategori/{kategori_id}', [KategoriController::class, 'updateAPIKategori']);
Route::post('createkategori',[KategoriController::class, 'createAPIKategori']);
Route::delete('deletekategori/{kategori_id}',[KategoriController::class, 'deleteAPIKategori']);

Route::get('/showbarang', [BarangController::class, 'showAPIBarang']);
Route::post('editbarang/{barang_id}', [BarangController::class, 'updateAPIBarang']);
Route::post('createbarang',[BarangController::class, 'createAPIBarang']);
Route::delete('deletebarang/{barang_id}',[BarangController::class, 'deleteAPIBarang']);
