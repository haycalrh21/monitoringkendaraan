<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtasanControler;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [Admincontroller::class, 'index'])->name('admin');
    Route::get('/admin/pegawai', [Admincontroller::class, 'pegawai'])->name('pegawai');
    Route::get('/admin/kendaraan', [Admincontroller::class, 'kendaraan'])->name('kendaraan');
    Route::get('/admin/pemesanan', [Admincontroller::class, 'pemesanan'])->name('pemesanan');
    Route::get('/admin/pemakaian', [Admincontroller::class, 'pemakaian'])->name('pemakaian');
    Route::post('/kirimpegawai', [Admincontroller::class, 'kirimpegawai'])->name('kirimpegawai');
    Route::post('/kirimkendaraan', [Admincontroller::class, 'kirimkendaraan'])->name('kirimkendaraan');
    Route::post('/kirimpemesanan', [Admincontroller::class, 'kirimpemesanan'])->name('kirimpemesanan');
    Route::post('/kirimpemakaian', [Admincontroller::class, 'kirimpemakaian'])->name('kirimpemakaian');
    Route::get('/pemesanan/export', [Admincontroller::class, 'export'])->name('pemesanan.export');
    Route::get('/get-data/{id}', [Admincontroller::class, 'getData']);
});

Route::middleware(['auth', 'role:atasan'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/persetejuan', [AtasanControler::class, 'persetejuan'])->name('persetejuan');
    Route::put('/gantistatus/{id}', [AtasanControler::class, 'gantistatus'])->name('gantistatus');
});

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
