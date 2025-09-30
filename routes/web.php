<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriSuratController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\HomeController;

Route::get('/', [ArsipSuratController::class, 'index'])->name('dashboard');

Route::resource('kategori', KategoriSuratController::class);
Route::resource('arsip', ArsipSuratController::class);

// Route tambahan untuk download
Route::get('/arsip/{arsip}/download', [ArsipSuratController::class, 'download'])->name('arsip.download');

// Route untuk halaman About
Route::get('/about', [HomeController::class, 'about'])->name('about');
