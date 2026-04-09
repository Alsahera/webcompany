<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@lakos.com'],
            [
                'name'     => 'Admin LaKost',
                'email'    => 'admin@lakos.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Akun admin berhasil dibuat.');
        $this->command->info('   Email   : admin@lakos.com');
        $this->command->info('   Password: 12345678');
    }
}