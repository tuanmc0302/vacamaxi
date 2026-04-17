<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'full_name' => 'Test User',
                'username' => 'testuser',
                'password' => bcrypt('password'),
            ]
        );

        $this->call([
            BackendAccessSeeder::class,
            FrontendWidgetSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
