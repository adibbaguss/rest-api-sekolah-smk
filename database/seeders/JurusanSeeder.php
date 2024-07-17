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
        DB::table('jurusan')->insert([
            'kode_jurusan' => '39944',
            'nama_jurusan' => 'Matematika',
        ]);
    }
}
