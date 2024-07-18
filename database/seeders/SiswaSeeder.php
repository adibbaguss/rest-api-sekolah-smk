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

        // Assuming you already have up to 4 jurusan records in the 'jurusan' table
        $jurusanIds = DB::table('jurusan')->pluck('id')->take(4)->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('siswa')->insert([
                'nisn' => $faker->unique()->numerify('##########'),
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tanggal_lahir' => $faker->date('Y-m-d', '2005-12-31'),
                'tempat_lahir' => $faker->city,
                'alamat' => $faker->address,
                'nomor_telepon' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'id_jurusan' => $faker->randomElement($jurusanIds),
                'status_aktif' => $faker->randomElement(['aktif', 'lulus']),
                'tahun_masuk' => $faker->numberBetween(2018, 2021),
                'tahun_lulus' => $faker->optional()->numberBetween(2022, 2024),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
