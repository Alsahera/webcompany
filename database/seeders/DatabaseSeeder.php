<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,    // Akun admin: admin@lakos.com / 12345678
            DemoDataSeeder::class, // Data contoh: kos, booking, pembayaran
        ]);
    }
}