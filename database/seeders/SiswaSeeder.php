<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('siswa')->insert([
            'nisn' => '1234567890',
            'nama_lengkap' => 'Adib Bagus Sudiyono',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2000-01-01',
            'tempat_lahir' => 'Batang',
            'alamat' => 'Jl. Kebon Jeruk No. 123',
            'nomor_telepon' => '081234567890',
            'email' => 'adib@example.com',
            'id_jurusan' => 1,
            'status_aktif' => 'aktif',
            'tahun_masuk' => 2019,
            'tahun_lulus' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
