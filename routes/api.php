<?php

use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\JadwalPelajaranController;
use App\Http\Controllers\Api\JurusanController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\MataPelajaranController;
use App\Http\Controllers\Api\MengajarController;
use App\Http\Controllers\Api\NilaiController;
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

// mata pelajaran
Route::apiResource('/mata_pelajaran', MataPelajaranController::class);

// kelas
Route::apiResource('/kelas', KelasController::class);

// kelas
Route::apiResource('/mengajar', MengajarController::class);

// nilai
Route::apiResource('/nilai', NilaiController::class);

// jadwal pelajaran
Route::apiResource('/jadwal_pelajaran', JadwalPelajaranController::class);
