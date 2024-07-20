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
//mengambil data siswa dan nilainya
Route::get('/siswa/{id}/nilai', [SiswaController::class, 'getNilaiBySiswa']);
// mengambil data jadwal pelajaran siswa
Route::get('/siswa/{id}/jadwal_pelajaran', [SiswaController::class, 'getJadwalBySiswa']);

// jurusan
Route::apiResource('/jurusan', JurusanController::class);

// guru
Route::apiResource('/guru', GuruController::class);
// mengambil data jadwal guru by id
Route::get('/guru/{id}/jadwal', [GuruController::class, 'getMengajarByGuru']);

// mata pelajaran
Route::apiResource('/mata_pelajaran', MataPelajaranController::class);

// kelas
Route::apiResource('/kelas', KelasController::class);
// mengambil data siswa per kelas
Route::get('/kelas/{id}/siswa', [KelasController::class, 'getSiswaByKelas']);

Route::get('/kelas/{kelasid}/nilai/{mataPelajaranId}', [KelasController::class, 'getNilaiByKelasAndMataPelajaran']);

// mengajar
Route::apiResource('/mengajar', MengajarController::class);

// nilai
Route::apiResource('/nilai', NilaiController::class);

// jadwal pelajaran
Route::apiResource('/jadwal_pelajaran', JadwalPelajaranController::class);
// mengambil jadwal pelajaran berdasarkan hari
Route::get('/jadwal_pelajaran/hari/{hari}', [JadwalPelajaranController::class, 'getJadwalByHari']);
