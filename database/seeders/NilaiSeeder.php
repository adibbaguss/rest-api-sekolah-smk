<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all siswa and mapel IDs
        $siswaIds = DB::table('siswa')->pluck('id')->toArray();
        $mapelIds = DB::table('mata_pelajaran')->pluck('id')->toArray();

        // Insert random nilai for 100 records
        for ($i = 0; $i < 100; $i++) {
            DB::table('nilai')->insert([
                'id_siswa' => $faker->randomElement($siswaIds),
                'id_mapel' => $faker->randomElement($mapelIds),
                'nilai_angka' => $faker->randomFloat(2, 0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
