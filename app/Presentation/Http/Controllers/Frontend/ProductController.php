<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FrontendWidget;
use App\Models\Post;
use App\Models\Product;
use App\Presentation\Http\Controllers\Frontend\NewsController;
use App\Services\MenuService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class ProductController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->filled('category')) {
            return redirect()->route('frontend.products.category', ['categorySlug' => $request->string('category')]);
        }

        $frontendData = $this->frontendData();
        $categories = $this->productCategories();
        $search = trim((string) $request->string('search'));
        $sort = (string) $request->string('sort', 'newest');

        $featuredProducts = $this->products()
            ->with('category')
            ->latest('id')
            ->limit(4)
            ->get();

        $productsByCategory = $categories->mapWithKeys(function (Category $category) use ($search, $sort): array {
            $products = $this->products()
                ->with('category')
                ->where('category_id', $category->id)
                ->when($search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"));

            $this->applySort($products, $sort);

            return [$category->id => $products->limit(4)->get()];
        });

        try {
            $breedsWidget = FrontendWidget::query()
                ->where('is_active', true)
                ->where('key', 'product_option_one')
                ->first();
        } catch (Throwable) {
            $breedsWidget = null;
        }

        $breedsItems = [];
        if ($breedsWidget) {
            $categoryId = data_get($breedsWidget->settings, 'category_id') ?: Category::query()
                ->where('module', Category::MODULE_PRODUCT)
                ->where('is_active', true)
                ->where('slug', data_get($breedsWidget->settings, 'category_slug', 'giong-bo-vacamaxi'))
                ->value('id');

            if ($categoryId) {
                $products = Product::query()
                    ->with('category')
                    ->where('is_active', true)
                    ->where('category_id', $categoryId)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->limit(4)
                    ->get();

                $breedsItems = $products->map(fn (Product $product): array => [
                    'image' => $product->image ? asset($product->image) : asset('image/Rectangle 11.png'),
                    'title' => $product->name,
                    'description' => $product->short_description ?: Str::limit(strip_tags($product->description ?? ''), 90),
                    'url' => $product->category
                        ? route('frontend.product.show', ['categorySlug' => $product->category->slug, 'productSlug' => $product->slug])
                        : route('frontend.products.index'),
                ])->all();
            }
        }

        if (empty($breedsItems)) {
            $breedsItems = $frontendData['breeds'] ?? [];
        }

        // Fetch news widget and items
        try {
            $newsWidget = FrontendWidget::query()
                ->where('is_active', true)
                ->where('key', 'news_home')
                ->first();
        } catch (Throwable) {
            $newsWidget = null;
        }

        $news = Post::query()
            ->where('is_active', true)
            ->with('category')
            ->latest('published_at')
            ->limit(8)
            ->get();

        return view('frontend.products.index', [
            'frontendData' => $frontendData,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'productsByCategory' => $productsByCategory,
            'breedsWidget' => $breedsWidget,
            'breedsItems' => $breedsItems,
            'newsWidget' => $newsWidget,
            'news' => $news,
            'filters' => [
                'search' => $search,
                'sort' => $sort,
            ],
        ]);
    }

    public function category(Request $request, string $products, string $categorySlug): View|RedirectResponse
    {
        if (in_array($categorySlug, ['bo', 'giong-bo-vacamaxi', 'cattle', 'breeds'], true)) {
            return redirect()->route('frontend.products.breeds');
        }

        $frontendData = $this->frontendData();
        $categories = $this->productCategories();
        $category = $categories->first(fn($c) => $c->slug === $categorySlug || $c->slug_en === $categorySlug) ?? abort(404);
        $sort = (string) $request->string('sort', 'newest');
        $search = trim((string) $request->string('search'));

        $products = $this->products()
            ->with('category')
            ->where('category_id', $category->id)
            ->when($search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"));

        $this->applySort($products, $sort);

        return view('frontend.products.category', [
            'frontendData' => $frontendData,
            'categories' => $categories,
            'category' => $category,
            'products' => $products->paginate(12)->withQueryString(),
            'filters' => [
                'search' => $search,
                'sort' => $sort,
            ],
        ]);
    }

    public function breeds(Request $request, ?string $products = null, ?string $breeds = null): View
    {
        $frontendData = $this->frontendData();
        $breedCategory = Category::where('module', Category::MODULE_PRODUCT)
            ->where(fn($q) => $q->whereIn('slug', ['giong-bo-vacamaxi', 'bo'])->orWhereIn('slug_en', ['giong-bo-vacamaxi', 'bo', 'cattle', 'breeds']))
            ->firstOrFail();

        $breeds = Product::query()
            ->where('category_id', $breedCategory->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.products.breeds', [
            'frontendData' => $frontendData,
            'breeds' => $breeds,
        ]);
    }

    public function show(string $products, string $categorySlug, string $productSlug): View
    {
        $frontendData = $this->frontendData();

        $product = $this->products()
            ->with('category')
            ->where(fn($q) => $q->where('slug', $productSlug)->orWhere('slug_en', $productSlug))
            ->whereHas('category', function (Builder $query) use ($categorySlug): void {
                $query->where('module', Category::MODULE_PRODUCT)
                    ->where(fn($q) => $q->where('slug', $categorySlug)->orWhere('slug_en', $categorySlug));
            })
            ->firstOrFail();

        $relatedProducts = $this->products()
            ->with('category')
            ->whereKeyNot($product->id)
            ->when($product->category_id, fn (Builder $query) => $query->where('category_id', $product->category_id))
            ->latest('id')
            ->limit(4)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = $this->products()
                ->with('category')
                ->whereKeyNot($product->id)
                ->latest('id')
                ->limit(4)
                ->get();
        }

        return view('frontend.products.show', [
            'frontendData' => $frontendData,
            'categories' => $this->productCategories(),
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public static function imageUrl(?string $path, string $fallback = 'image/Rectangle 11.png'): string
    {
        $path = $path ?: $fallback;

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        return asset($path);
    }

    public static function productUrl(Product $product): string
    {
        if (! $product->category) {
            return route('frontend.products.index');
        }

        $locale = \Illuminate\Support\Facades\App::getLocale();
        $categorySlug = \App\Helpers\SlugHelper::translate($product->category->slug, $locale);
        $productSlug = \App\Helpers\SlugHelper::translate($product->slug, $locale);

        return route('frontend.product.show', ['categorySlug' => $categorySlug, 'productSlug' => $productSlug]);
    }

    private function products(): Builder
    {
        return Product::query()
            ->where('is_active', true)
            ->whereHas('category', function (Builder $query): void {
                $query->where('module', Category::MODULE_PRODUCT)
                    ->where('is_active', true);
            });
    }

    private function productCategories(): Collection
    {
        return Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('is_active', true)
            ->whereNotIn('slug', ['bo', 'giong-bo-vacamaxi'])
            ->withCount(['products' => fn (Builder $query) => $query->where('is_active', true)])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    private function applySort(Builder $query, string $sort): void
    {
        match ($sort) {
            'newest' => $query->orderByDesc('id'),
            'oldest' => $query->orderBy('id'),
            'name_asc' => $query->orderBy('name'),
            'name_desc' => $query->orderByDesc('name'),
            default => $query->orderBy('sort_order')->orderByDesc('id'),
        };
    }

    private function frontendData(): array
    {
        $path = resource_path('data/frontend.json');
        $frontendData = is_file($path) ? (json_decode(file_get_contents($path), true) ?: []) : [];
        $frontendData['nav'] = app(MenuService::class)->getFrontendMenu();

        return $frontendData;
    }
}
