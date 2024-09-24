<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalTimController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuangController;
use App\Models\Ruang;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/ruang', RuangController::class);
Route::resource('/jadwal',JadwalController::class);
Route::resource('/jadwaltim',JadwalTimController::class);

require __DIR__.'/auth.php';
