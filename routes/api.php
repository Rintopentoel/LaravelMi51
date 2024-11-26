<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RuangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ruang', [RuangController::class, 'getRuang']);
Route::post('/ruang', [RuangController::class, 'storeRuang']);

Route::get('/jadwal', [JadwalController::class, 'getJadwal']);
Route::post('/jadwal', [JadwalController::class, 'storeJadwal']);
