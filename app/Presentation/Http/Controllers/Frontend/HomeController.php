<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FrontendWidget;
use App\Models\Post;
use App\Models\Product;
use App\Models\Expert;
use App\Services\MenuService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function __construct(
        private readonly MenuService $menuService
    ) {}

    private const HOME_WIDGET_KEYS = [
        'banner_home',
        'about_me_home',
        'product_option_one',
        'about_team_home',
        'product_option_two',
        'product_option_three',
        'about_restaurant_home',
        'feedback_home',
        'news_home',
    ];

    private const PRODUCT_OPTION_KEYS = [
        'product_option_one',
        'product_option_two',
        'product_option_three',
    ];

    private const PRODUCT_OPTION_CATEGORY_SLUGS = [
        'product_option_one' => 'giong-bo-vacamaxi',
        'product_option_two' => 'thit-bo',
        'product_option_three' => 'ruou',
    ];

    public function __invoke(): View
    {
        $frontendData = json_decode(file_get_contents(resource_path('data/frontend.json')), true) ?: [];
        $frontendData['nav'] = $this->menuService->getFrontendMenu();

        try {
            $widgets = FrontendWidget::query()
                ->where('is_active', true)
                ->whereIn('key', self::HOME_WIDGET_KEYS)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->keyBy('key');
        } catch (Throwable) {
            $widgets = new Collection();
        }

        $experts = Expert::where('is_active', true)->orderBy('sort_order')->take(4)->get();

        return view('frontend.home', [
            'frontendData' => $frontendData,
            'footer' => $frontendData['footer'] ?? [],
            'widgets' => $widgets,
            'experts' => $experts,
            'productOptionItems' => $this->productOptionItems($widgets),
            'news' => $this->latestNews(),
        ]);
    }

    private function latestNews(): Collection
    {
        return Post::query()
            ->where('is_active', true)
            ->with('category')
            ->latest('published_at')
            ->limit(8)
            ->get();
    }

    private function productOptionItems(Collection $widgets): array
    {
        $items = [];

        foreach (self::PRODUCT_OPTION_KEYS as $widgetKey) {
            $categoryId = $this->productOptionCategoryId($widgets, $widgetKey);

            if (! $categoryId) {
                continue;
            }

            $products = Product::query()
                ->with('category')
                ->where('is_active', true)
                ->where('category_id', $categoryId)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->limit(4)
                ->get();

            if ($products->isEmpty()) {
                continue;
            }

            $items[$widgetKey] = $products->map(fn (Product $product): array => [
                'image' => $product->image ? asset($product->image) : asset('image/Rectangle 11.png'),
                'title' => $product->name,
                'description' => $product->short_description ?: Str::limit(strip_tags($product->description ?? ''), 90),
                'url' => $product->category
                    ? route('frontend.product.show', [$product->category->slug, $product->slug])
                    : route('frontend.products.index'),
            ])->all();
        }

        return $items;
    }

    private function productOptionCategoryId(Collection $widgets, string $widgetKey): ?int
    {
        $settings = $widgets->get($widgetKey)?->settings ?? [];
        $categoryId = data_get($settings, 'category_id');

        if ($categoryId) {
            return (int) $categoryId;
        }

        $categorySlug = data_get($settings, 'category_slug') ?: self::PRODUCT_OPTION_CATEGORY_SLUGS[$widgetKey] ?? null;

        if (! $categorySlug) {
            return null;
        }

        return Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('is_active', true)
            ->where('slug', $categorySlug)
            ->value('id');
    }
}
