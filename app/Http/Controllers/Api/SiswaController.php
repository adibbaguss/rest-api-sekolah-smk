<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return new SiswaResource(true, 'List Data Siswa', $siswa);
    }
}
