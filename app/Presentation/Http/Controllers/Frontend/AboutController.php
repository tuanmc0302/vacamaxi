<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FrontendWidget;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class AboutController extends Controller
{
    private const ABOUT_WIDGET_KEYS = [
        'about_page_hero',
        'about_page_intro',
        'about_page_values',
        'about_page_experts',
        'about_page_farm',
        'about_page_cta',
    ];

    private const ABOUT_SCALE_WIDGET_KEYS = [
        'about_scale_page_hero',
        'about_scale_page_farm',
        'about_scale_page_experts',
        'about_scale_page_care',
        'about_scale_page_biotech',
        'about_scale_page_ivf',
        'about_scale_page_strategy',
        'about_scale_page_cta',
    ];

    public function show(): View
    {
        return view('frontend.about', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgetsFor(self::ABOUT_WIDGET_KEYS),
            'expertProducts' => $this->latestExpertProducts(),
        ]);
    }

    public function figma(): View
    {
        return view('frontend.about-figma', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgetsFor(self::ABOUT_WIDGET_KEYS),
            'expertProducts' => $this->latestExpertProducts(),
        ]);
    }

    public function scale(): View
    {
        return view('frontend.about-scale', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgetsFor(self::ABOUT_SCALE_WIDGET_KEYS),
            'expertProducts' => $this->latestExpertProducts(8),
        ]);
    }

    public function scaleFigma(): View
    {
        return view('frontend.about-scale-figma', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgetsFor(self::ABOUT_SCALE_WIDGET_KEYS),
            'expertProducts' => $this->latestExpertProducts(8),
        ]);
    }

    private function frontendData(): array
    {
        return json_decode(file_get_contents(resource_path('data/frontend.json')), true) ?: [];
    }

    private function widgetsFor(array $keys): Collection
    {
        try {
            return FrontendWidget::query()
                ->where('is_active', true)
                ->whereIn('key', $keys)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->keyBy('key');
        } catch (Throwable) {
            return new Collection();
        }
    }

    private function latestExpertProducts(int $limit = 8): Collection
    {
        try {
            return Product::query()
                ->with('category')
                ->where('is_active', true)
                ->whereHas('category', function ($query) {
                    $query->where('module', Category::MODULE_PRODUCT)
                        ->where('slug', 'chuyen-gia');
                })
                ->orderByDesc('id')
                ->take($limit)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }
}
