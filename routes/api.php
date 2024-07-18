<?php

use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// siswa
Route::apiResource('/siswa', SiswaController::class);

// jurusan
Route::apiResource('/jurusan', JurusanController::class);

// guru
Route::apiResource('/guru', GuruController::class);
