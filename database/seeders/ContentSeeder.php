<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = ['Rượu', 'Bò', 'Chuyên gia'];

        foreach ([Category::MODULE_PRODUCT, Category::MODULE_NEWS] as $module) {
            foreach ($categoryNames as $index => $name) {
                Category::query()->updateOrCreate(
                    ['module' => $module, 'slug' => Str::slug($name)],
                    [
                        'name' => $name,
                        'description' => null,
                        'sort_order' => $index + 1,
                        'is_active' => true,
                    ],
                );
            }
        }
    }
}
