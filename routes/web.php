<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\JadwalTimController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/gedung', GedungController::class)->middleware(['auth', 'verified']);
// Route::resource('/jadwaltim',JadwalTimController::class);
Route::resource('/user', UserController::class)->middleware(['auth', 'verified']);
Route::resource('/permintaan', PermintaanController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
