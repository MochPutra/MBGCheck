<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminJadwalMenuController;
use App\Http\Controllers\AdminMakananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateResepController;
use App\Http\Controllers\JadwalMenuController;
use App\Http\Controllers\KalkulatorGiziController;
use App\Http\Controllers\MakananController;

// Rute Publik
Route::get('/', [MakananController::class, 'index']);
Route::get('/dashboard', [AdminDashboardController::class, 'index']);
Route::get('/kalkulator', [KalkulatorGiziController::class, 'index']);
Route::post('/kalkulator', [KalkulatorGiziController::class, 'hitung']);
Route::get('/jadwal-menu', [JadwalMenuController::class, 'show']);

// Rute Autentikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'validasiLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

// Rute Halaman Admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
Route::get('/admin/makanan', [AdminMakananController::class, 'index']);
Route::get('/admin/makanan/create', [AdminMakananController::class, 'create']);
Route::post('/admin/makanan', [AdminMakananController::class, 'store']);
Route::get('/admin/makanan/export', [AdminMakananController::class, 'export']);
Route::post('/admin/makanan/{id}/generate-resep', [GenerateResepController::class, 'generate']);
Route::get('/makanan/{id}', [MakananController::class, 'show']);

// Rute Admin Jadwal Menu
Route::get('/admin/jadwal-menu', [AdminJadwalMenuController::class, 'index']);
Route::post('/admin/jadwal-menu', [AdminJadwalMenuController::class, 'store']);
Route::delete('/admin/jadwal-menu/{id_jadwal}', [AdminJadwalMenuController::class, 'destroy']);
Route::get('/admin/jadwal-menu/search', [AdminJadwalMenuController::class, 'searchMakanan']);
