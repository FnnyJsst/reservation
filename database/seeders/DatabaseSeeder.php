<?php

namespace Database\Seeders;

// DatabaseSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $existingUser = User::where('email', 'test@example.com')->first();

        if (!$existingUser) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'), // Remplacez 'password' par le mot de passe hashé souhaité
            ]);
        }
    }
}
