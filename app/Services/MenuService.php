<?php

namespace App\Services;

use App\Models\MenuItem;
use Throwable;

class MenuService
{
    public function getFrontendMenu(): array
    {
        try {
            $items = MenuItem::query()
                ->with(['children' => function ($query) {
                    $query
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id');
                }])
                ->where('is_active', true)
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();

            if ($items->isEmpty()) {
                return $this->fallbackMenu();
            }

            return $items->map(function ($item) {
                $data = [
                    'label' => $item->label,
                    'url' => $item->url,
                    'key' => $item->key,
                    'target' => $item->target ?: '_self',
                ];

                if ($item->children->isNotEmpty()) {
                    $data['children'] = $item->children->map(function ($child) {
                        return [
                            'label' => $child->label,
                            'url' => $child->url,
                            'key' => $child->key,
                            'target' => $child->target ?: '_self',
                        ];
                    })->toArray();
                }

                return $data;
            })->toArray();
        } catch (Throwable) {
            return $this->fallbackMenu();
        }
    }

    private function fallbackMenu(): array
    {
        $path = resource_path('data/frontend.json');

        if (! is_file($path)) {
            return [];
        }

        $data = json_decode((string) file_get_contents($path), true);

        return is_array($data) ? ($data['nav'] ?? []) : [];
    }
}
