<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\GuruSeeder;
use Database\Seeders\JadwalPelajaranSeeder;
use Database\Seeders\JurusanSeeder;
use Database\Seeders\KelasSeeder;
use Database\Seeders\MataPelajaranSeeder;
use Database\Seeders\MengajarSeeder;
use Database\Seeders\NilaiSeeder;
use Database\Seeders\SiswaSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            JurusanSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            GuruSeeder::class,
            MataPelajaranSeeder::class,
            MengajarSeeder::class,
            NilaiSeeder::class,
            JadwalPelajaranSeeder::class,
        ]);
    }
}
