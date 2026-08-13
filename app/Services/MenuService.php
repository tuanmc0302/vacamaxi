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

            $locale = app()->getLocale();

            return $items->map(function ($item) use ($locale) {
                $url = $item->url;
                if ($locale === 'en' && str_starts_with($url, '/') && !str_starts_with($url, '/en')) {
                    $url = '/en' . ($url === '/' ? '' : $url);
                }

                $data = [
                    'label' => $item->label,
                    'url' => $url,
                    'key' => $item->key,
                    'target' => $item->target ?: '_self',
                ];

                if ($item->children->isNotEmpty()) {
                    $data['children'] = $item->children->map(function ($child) use ($locale) {
                        $childUrl = $child->url;
                        if ($locale === 'en' && str_starts_with($childUrl, '/') && !str_starts_with($childUrl, '/en')) {
                            $childUrl = '/en' . ($childUrl === '/' ? '' : $childUrl);
                        }

                        return [
                            'label' => $child->label,
                            'url' => $childUrl,
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
        $nav = is_array($data) ? ($data['nav'] ?? []) : [];
        $locale = app()->getLocale();

        return collect($nav)->map(function ($item) use ($locale) {
            $url = $item['url'] ?? '#';
            if ($locale === 'en' && str_starts_with($url, '/') && !str_starts_with($url, '/en')) {
                $url = '/en' . ($url === '/' ? '' : $url);
            }

            $mapped = [
                'label' => __($item['label'] ?? ''),
                'url' => $url,
                'key' => $item['key'] ?? '',
                'target' => $item['target'] ?? '_self',
            ];

            if (!empty($item['children'])) {
                $mapped['children'] = collect($item['children'])->map(function ($child) use ($locale) {
                    $childUrl = $child['url'] ?? '#';
                    if ($locale === 'en' && str_starts_with($childUrl, '/') && !str_starts_with($childUrl, '/en')) {
                        $childUrl = '/en' . ($childUrl === '/' ? '' : $childUrl);
                    }

                    return [
                        'label' => __($child['label'] ?? ''),
                        'url' => $childUrl,
                        'key' => $child['key'] ?? '',
                        'target' => $child['target'] ?? '_self',
                    ];
                })->all();
            }

            return $mapped;
        })->all();
    }
}
