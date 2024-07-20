<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all kelas, mapel, and mengajar IDs
        $kelasIds = DB::table('kelas')->pluck('id')->toArray();
        $mapelIds = DB::table('mata_pelajaran')->pluck('id')->toArray();
        $mengajarIds = DB::table('mengajar')->pluck('id')->toArray();

        // Insert random jadwal pelajaran for 50 records
        for ($i = 0; $i < 50; $i++) {
            // Generate a random time between 07:00 and 14:00
            $startTimestamp = strtotime('07:00');
            $endTimestamp = strtotime('14:00');
            $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
            $jamPelajaran = date('H:i', $randomTimestamp);

            DB::table('jadwal_pelajaran')->insert([
                'id_kelas' => $faker->randomElement($kelasIds),
                'id_mapel' => $faker->randomElement($mapelIds),
                'id_mengajar' => $faker->randomElement($mengajarIds),
                'hari' => $faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']),

                'jam_pelajaran' => $jamPelajaran,
                'semester' => $faker->randomElement([1, 2]),
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);
        }
    }
}
