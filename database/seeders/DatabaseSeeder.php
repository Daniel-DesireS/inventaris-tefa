<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    // Menjalankan data awal untuk mengisi database demo

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            BarangSeeder::class,
            PeminjamSeeder::class,
            PeminjamanSeeder::class,
        ]);
    }
}
