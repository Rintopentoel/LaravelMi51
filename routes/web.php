<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalTimController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\UserController;
use App\Models\Ruang;
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

Route::resource('/ruang', RuangController::class)->middleware(['auth', 'verified']);
// Route::resource('/jadwaltim',JadwalTimController::class);
Route::resource('/user', UserController::class)->middleware(['auth', 'verified']);
Route::resource('/jadwal',JadwalController::class)->middleware(['auth', 'verified']);

Route::middleware( ['auth','verified', 'checkRole:admin'])
    ->group( function () {
        
        Route::delete('/ruang/{ruang}', [RuangController::class, 'destroy'])
        
        ->name('ruang.destroy');
        
        Route::put('/ruang/{ruang}', [RuangController::class, 'update'])
        
        ->name('ruang.update');
        
    });
// Route::put('/ruang/{ruang}', [RuangController::class, 'update'])->middleware(['auth', 'verified', 'checkRole:admin']);
// Route::delete('/ruang/{ruang}', [RuangController::class, 'destroy'])->middleware(['auth', 'verified', 'checkRole:admin']);

require __DIR__.'/auth.php';
