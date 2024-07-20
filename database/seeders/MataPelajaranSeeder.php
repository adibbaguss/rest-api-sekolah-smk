<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar mata pelajaran untuk setiap jurusan
        $mapel = [
            'TKJ' => [
                'Administrasi Sistem Jaringan',
                'Teknologi Layanan Jaringan',
                'Komputer dan Jaringan Dasar',
                'Pemrograman Dasar',
                'Sistem Operasi',
                'Jaringan Dasar',
                'Desain Grafis',
                'Web Programming',
                'Basis Data',
            ],
            'RPL' => [
                'Algoritma dan Pemrograman',
                'Basis Data',
                'Pemrograman Berorientasi Objek',
                'Pemrograman Web dan Mobile',
                'Desain Grafis',
                'Jaringan Komputer',
                'Rekayasa Perangkat Lunak',
                'Pemrograman Dasar',
                'Sistem Informasi',
            ],
            'MM' => [
                'Desain Grafis',
                'Multimedia Dasar',
                'Animasi 2D dan 3D',
                'Desain Media Interaktif',
                'Teknik Pengolahan Audio Video',
                'Komputer dan Jaringan Dasar',
                'Pemrograman Dasar',
                'Web Design',
                'Fotografi',
            ],
            'Akuntansi' => [
                'Akuntansi Dasar',
                'Aplikasi Akuntansi',
                'Praktikum Akuntansi',
                'Administrasi Pajak',
                'Komputer Akuntansi',
                'Manajemen Keuangan',
                'Matematika Keuangan',
                'Perpajakan',
                'Audit',
            ],
        ];

        // Insert data ke dalam tabel mata_pelajaran
        foreach ($mapel as $jurusan => $nama_mapel_list) {
            foreach ($nama_mapel_list as $nama_mapel) {
                DB::table('mata_pelajaran')->insert([
                    'kode_mapel' => strtoupper($jurusan) . '-' . uniqid(),
                    'nama_mapel' => $nama_mapel,
                    // 'created_at' => now(),
                    // 'updated_at' => now(),
                ]);
            }
        }
    }
}
