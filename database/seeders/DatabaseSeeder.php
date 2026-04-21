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
        User::query()->updateOrCreate(
            ['username' => 'admin'],
            [
                'full_name' => 'Administrator',
                'email' => 'admin@vacamaxi.com',
                'password' => bcrypt('admin123'),
            ]
        );

        $this->call([
            SiteSettingSeeder::class,
            FrontendWidgetSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
