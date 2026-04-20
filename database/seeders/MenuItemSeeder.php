<?php

namespace database\seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $path = resource_path('data/frontend.json');
        if (!File::exists($path)) return;

        $data = json_decode(File::get($path), true);
        $nav = $data['nav'] ?? [];

        foreach ($nav as $index => $item) {
            $parent = MenuItem::create([
                'label' => $item['label'],
                'url' => $item['url'],
                'key' => $item['key'] ?? null,
                'sort_order' => $index,
                'is_active' => true,
            ]);

            if (isset($item['children'])) {
                foreach ($item['children'] as $childIndex => $child) {
                    MenuItem::create([
                        'label' => $child['label'],
                        'url' => $child['url'],
                        'key' => $child['key'] ?? null,
                        'parent_id' => $parent->id,
                        'sort_order' => $childIndex,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
