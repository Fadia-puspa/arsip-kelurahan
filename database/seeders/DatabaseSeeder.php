<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       // 1 Admin
        User::create([
            'name' => 'Sekretariat Kelurahan',
            'email' => 'sekretariat@kelurahan.com',
            'email_verified_at' => now(),
            'password' => Hash::make('sekretariat123'), // Ganti dengan password yang aman
            'role' => 'sekretariat',
        ]);

        
        
    }
}
