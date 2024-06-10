<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
//ini untuk login
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/show', [KategoriController::class, 'showAPIKategori']);
Route::post('kategori/{kategori_id}', [KategoriController::class, 'updateAPIKategori']);
Route::post('create',[KategoriController::class, 'createAPIKategori']);
Route::delete('delete/{kategori_id}',[KategoriController::class, 'deleteAPIKategori']);
