<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default NEXORA admin account for local/dev use.
        // firstOrCreate() so re-running `php artisan db:seed` is safe and
        // won't error out or duplicate the account.
        //
        // Login with:
        //   email:    admin@nexora.test
        //   password: password
        //
        // Change this password immediately if this is ever run anywhere
        // other than local development.
        User::firstOrCreate(
            ['email' => 'admin@nexora.test'],
            [
                'name' => 'Vallen',
                'password' => 'password', // hashed automatically via the model's 'hashed' cast
                'email_verified_at' => now(),
            ]
        );
    }
}
