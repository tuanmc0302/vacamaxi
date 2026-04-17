<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontendWidget;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    private const PRODUCT_OPTION_KEYS = [
        'product_option_one',
        'product_option_two',
        'product_option_three',
    ];

    public function __invoke(): View
    {
        $frontendData = json_decode(file_get_contents(resource_path('data/frontend.json')), true) ?: [];

        try {
            $widgets = FrontendWidget::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('key');
        } catch (Throwable) {
            $widgets = new Collection();
        }

        return view('frontend.home', [
            'frontendData' => $frontendData,
            'widgets' => $widgets,
            'productOptionItems' => $this->productOptionItems($widgets),
        ]);
    }

    private function productOptionItems(Collection $widgets): array
    {
        $items = [];

        foreach (self::PRODUCT_OPTION_KEYS as $widgetKey) {
            $categoryId = data_get($widgets->get($widgetKey)?->settings, 'category_id');

            if (! $categoryId) {
                continue;
            }

            $products = Product::query()
                ->where('is_active', true)
                ->where('category_id', $categoryId)
                ->latest('id')
                ->limit(4)
                ->get();

            if ($products->isEmpty()) {
                continue;
            }

            $items[$widgetKey] = $products->map(fn (Product $product): array => [
                'image' => $product->image ? asset($product->image) : asset('image/Rectangle 11.png'),
                'title' => $product->name,
                'description' => $product->short_description ?: Str::limit(strip_tags($product->description ?? ''), 90),
                'url' => route('frontend.product-detail'),
            ])->all();
        }

        return $items;
    }
}