<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\AuthController;

// Rute Publik
Route::get('/', [MakananController::class, 'index']);

// Rute Autentikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'validasiLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

use App\Http\Controllers\AdminMakananController;

// ... (rute yang sudah ada sebelumnya biarkan saja) ...

// Rute Halaman Admin
Route::get('/admin/makanan', [AdminMakananController::class, 'index']);
Route::get('/admin/makanan/create', [AdminMakananController::class, 'create']);
Route::post('/admin/makanan', [AdminMakananController::class, 'store']);