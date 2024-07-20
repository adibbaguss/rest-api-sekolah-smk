<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = [
            ['kode_jurusan' => '001', 'nama_jurusan' => 'Teknik Komputer dan Jaringan'],
            ['kode_jurusan' => '002', 'nama_jurusan' => 'Multimedia'],
            ['kode_jurusan' => '003', 'nama_jurusan' => 'Rekayasa Perangkat Lunak'],
            ['kode_jurusan' => '004', 'nama_jurusan' => 'Akuntansi'],
        ];

        foreach ($jurusan as $j) {
            DB::table('jurusan')->insert([
                'kode_jurusan' => $j['kode_jurusan'],
                'nama_jurusan' => $j['nama_jurusan'],
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);
        }
    }
}
