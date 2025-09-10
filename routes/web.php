<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Halaman dashboard setelah login
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/suratmasuk', [SuratMasukController::class, 'index']);
Route::get('/surat-masuk-{id}', [SuratMasukController::class, 'edit'])->name('surat-masuk.edit');
Route::get('/surat-keluar-{id}', [SuratKeluarController::class, 'edit'])->name('surat-keluar.edit');
Route::put('/update_suratmasuk/{id}', [SuratMasukController::class, 'update'])->name('update_suratmasuk');
Route::put('/update_suratkeluar/{id}', [SuratKeluarController::class, 'update'])->name('update_suratkeluar');
Route::get('/suratkeluar', [SuratKeluarController::class, 'index']);
Route::get('/uploadsurat', [SuratController::class, 'index']);
Route::post('/upload_surat', [SuratController::class, 'store']);
Route::get('/uploadsuratkeluar', [SuratKeluarController::class, 'create']);
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/updete_profile', [ProfileController::class, 'update'])->name('updete_profile');
Route::get('/surat-masuk/{id}/{nomor_item}', [SuratMasukController::class, 'destroy'])->name('surat-masuk.destroy');
Route::get('/surat-keluar/{id}/{nomor_item}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.destroy');
Route::get('/sinkron-nomor-item', [ArsipController::class, 'sinkronNomorItem'])->name('sinkron.nomor_item');

// Route::resource('surat-masuk', SuratMasukController::class);




// Redirect root ke dashboard jika sudah login
Route::get('/', function () {
    return view('index');
})->middleware('guest');












