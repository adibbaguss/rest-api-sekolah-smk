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

        foreach ($siswaIds as $siswaId) {
            // Insert at least 10 nilai for each siswa
            for ($i = 0; $i < 10; $i++) {
                DB::table('nilai')->insert([
                    'id_siswa' => $siswaId,
                    'id_mapel' => $faker->randomElement($mapelIds),
                    'nilai_angka' => $faker->randomFloat(2, 50, 100),
                    // 'created_at' => now(),
                    // 'updated_at' => now(),
                ]);
            }
        }
    }
}
