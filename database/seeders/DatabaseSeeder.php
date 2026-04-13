<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,    // Membuat akun admin: admin@lakos.com / 12345678
            // DemoDataSeeder::class, // Dimatikan sementara karena file tidak ditemukan
        ]);
    }
}