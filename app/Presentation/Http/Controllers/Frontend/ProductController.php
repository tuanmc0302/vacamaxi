<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\MenuService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->filled('category')) {
            return redirect()->route('frontend.products.category', $request->string('category'));
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

        return view('frontend.products.index', [
            'frontendData' => $frontendData,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'productsByCategory' => $productsByCategory,
            'filters' => [
                'search' => $search,
                'sort' => $sort,
            ],
        ]);
    }

    public function category(Request $request, string $categorySlug): View
    {
        if ($categorySlug === 'bo') {
            return redirect()->route('frontend.products.breeds');
        }

        $frontendData = $this->frontendData();
        $categories = $this->productCategories();
        $category = $categories->firstWhere('slug', $categorySlug) ?? abort(404);
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

    public function breeds(Request $request): View
    {
        $frontendData = $this->frontendData();
        $breedCategory = Category::where('module', Category::MODULE_PRODUCT)
            ->where('slug', 'bo')
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

    public function show(string $categorySlug, string $productSlug): View
    {
        $frontendData = $this->frontendData();

        $product = $this->products()
            ->with('category')
            ->where('slug', $productSlug)
            ->whereHas('category', function (Builder $query) use ($categorySlug): void {
                $query->where('module', Category::MODULE_PRODUCT)
                    ->where('slug', $categorySlug);
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

        return route('frontend.product.show', [$product->category->slug, $product->slug]);
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
            ->where('slug', '!=', 'bo')
            ->withCount(['products' => fn (Builder $query) => $query->where('is_active', true)])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    private function applySort(Builder $query, string $sort): void
    {
        match ($sort) {
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
