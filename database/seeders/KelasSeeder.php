<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = [
            'TKJ' => 'Teknik Komputer dan Jaringan',
            'MM' => 'Multimedia',
            'RPL' => 'Rekayasa Perangkat Lunak',
            'AK' => 'Akuntansi',
        ];

        $tahunAjaran = '2023/2024';
        $angkatan = [10, 11, 12]; // Contoh angkatan

        foreach ($jurusan as $singkatan => $namaJurusan) {
            foreach ($angkatan as $tahun) {
                for ($i = 1; $i <= 2; $i++) { // Setiap jurusan memiliki 2 kelas per angkatan
                    DB::table('kelas')->insert([
                        'nama_kelas' => $tahun . ' ' . $singkatan . '-' . $i,
                        'tahun_ajaran' => $tahunAjaran,
                        // 'created_at' => now(),
                        // 'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
