<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $guruIds = DB::table('guru')->pluck('id')->toArray();
        $mapelIds = DB::table('mata_pelajaran')->pluck('id')->toArray();
        $kelasIds = DB::table('kelas')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('mengajar')->insert([
                'kode_mengajar' => $faker->unique()->numerify('KM####'),
                'id_guru' => $faker->randomElement($guruIds),
                'id_kelas' => $faker->randomElement($kelasIds),
                'id_mapel' => $faker->randomElement($mapelIds),
                'semester' => $faker->numberBetween(1, 2),
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);
        }
    }
}
