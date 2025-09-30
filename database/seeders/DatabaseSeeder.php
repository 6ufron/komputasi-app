<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan model User diimport

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan akun default
        // User::create([
        //     'name' => 'Admin User', // Nama default pengguna
        //     'email' => 'admin@example.com', // Email default
        //     'password' => bcrypt('password123'), // Kata sandi terenkripsi
        // ]);

        // Jika Anda ingin membuat data pengguna lain secara massal:
        // \App\Models\User::factory(10)->create();
    }
}
