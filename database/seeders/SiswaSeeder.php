<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $jurusanIds = DB::table('jurusan')->pluck('id')->take(24)->toArray();

        for ($i = 0; $i < 330; $i++) {
            DB::table('siswa')->insert([
                'nisn' => $faker->unique()->numerify('##########'),
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tanggal_lahir' => $faker->dateTimeBetween('2005-01-01', '2008-12-31')->format('Y-m-d'),
                'tempat_lahir' => $faker->city,
                'alamat' => $faker->address,
                'nomor_telepon' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'id_jurusan' => $faker->randomElement($jurusanIds),
                'status_aktif' => 'aktif',
                'tahun_masuk' => $faker->numberBetween(2018, 2021),
                'tahun_lulus' => $faker->optional()->numberBetween(2022, 2024),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
