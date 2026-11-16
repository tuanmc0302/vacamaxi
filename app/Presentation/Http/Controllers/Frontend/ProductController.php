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
            $categoryIds = $category->children->pluck('id')->push($category->id)->all();

            $products = $this->products()
                ->with('category.parent')
                ->whereIn('category_id', $categoryIds)
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
                $breedCat = Category::query()->with('children')->find($categoryId);
                $categoryIds = $breedCat ? $breedCat->children->pluck('id')->push($breedCat->id)->all() : [$categoryId];

                $products = Product::query()
                    ->with('category.parent')
                    ->where('is_active', true)
                    ->whereIn('category_id', $categoryIds)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->limit(4)
                    ->get();

                $breedsItems = $products->map(fn (Product $product): array => [
                    'image' => $product->image ? asset($product->image) : asset('image/Rectangle 11.png'),
                    'title' => $product->name,
                    'description' => $product->short_description ?: Str::limit(strip_tags($product->description ?? ''), 90),
                    'url' => self::productUrl($product),
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

        $category = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->where('is_active', true)
            ->where(fn($q) => $q->where('slug', $categorySlug)->orWhere('slug_en', $categorySlug))
            ->with(['parent', 'children' => fn($q) => $q->where('is_active', true)->withCount(['products' => fn ($pq) => $pq->where('is_active', true)])->orderBy('sort_order')->orderBy('name')])
            ->first() ?? abort(404);

        $sort = (string) $request->string('sort', 'newest');
        $search = trim((string) $request->string('search'));
        $subSlug = trim((string) $request->string('sub'));

        if ($category->parent_id && $category->parent) {
            $rootCategory = $category->parent;
            $subcategories = $rootCategory->children;
            $activeSub = $category;
        } else {
            $rootCategory = $category;
            $subcategories = $category->children;
            $activeSub = $subSlug ? $subcategories->first(fn($s) => $s->slug === $subSlug || $s->slug_en === $subSlug) : null;
        }

        $productsBySubcategory = collect();
        $parentDirectProducts = collect();
        $products = null;

        $allCategoryIds = $rootCategory->children->pluck('id')->push($rootCategory->id)->all();

        if ($subcategories->isNotEmpty() && ! $activeSub) {
            $productsBySubcategory = $subcategories->mapWithKeys(function (Category $sub) use ($search, $sort) {
                $subCategoryIds = $sub->children->pluck('id')->push($sub->id)->all();

                $subQuery = $this->products()
                    ->with('category.parent')
                    ->whereIn('category_id', $subCategoryIds)
                    ->when($search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"));

                $this->applySort($subQuery, $sort);

                return [$sub->id => $subQuery->limit(4)->get()];
            });

            $parentDirectQuery = $this->products()
                ->with('category.parent')
                ->where('category_id', $rootCategory->id)
                ->when($search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"));
            $this->applySort($parentDirectQuery, $sort);
            $parentDirectProducts = $parentDirectQuery->limit(4)->get();
        } else {
            $targetCategoryIds = $activeSub 
                ? $activeSub->children->pluck('id')->push($activeSub->id)->all() 
                : $allCategoryIds;

            $productsQuery = $this->products()
                ->with('category.parent')
                ->whereIn('category_id', $targetCategoryIds)
                ->when($search !== '', fn (Builder $query) => $query->where('name', 'like', "%{$search}%"));

            $this->applySort($productsQuery, $sort);
            $products = $productsQuery->paginate(12)->withQueryString();
        }

        $requiresAgeVerification = $category->requiresAgeVerification()
            || ($rootCategory && $rootCategory->requiresAgeVerification())
            || ($activeSub && $activeSub->requiresAgeVerification());

        return view('frontend.products.category', [
            'frontendData' => $frontendData,
            'categories' => $categories,
            'category' => $category,
            'rootCategory' => $rootCategory,
            'subcategories' => $subcategories,
            'activeSub' => $activeSub,
            'productsBySubcategory' => $productsBySubcategory,
            'parentDirectProducts' => $parentDirectProducts,
            'products' => $products,
            'requiresAgeVerification' => $requiresAgeVerification,
            'filters' => [
                'search' => $search,
                'sort' => $sort,
                'sub' => $subSlug,
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
            ->with('category.parent')
            ->where(fn($q) => $q->where('slug', $productSlug)->orWhere('slug_en', $productSlug))
            ->whereHas('category', function (Builder $query) use ($categorySlug): void {
                $query->where('module', Category::MODULE_PRODUCT)
                    ->where(function (Builder $cq) use ($categorySlug) {
                        $cq->where('slug', $categorySlug)
                            ->orWhere('slug_en', $categorySlug)
                            ->orWhereHas('parent', function (Builder $pq) use ($categorySlug) {
                                $pq->where('slug', $categorySlug)
                                    ->orWhere('slug_en', $categorySlug);
                            });
                    });
            })
            ->firstOrFail();

        $relatedCategoryIds = array_filter([$product->category_id]);
        if ($product->category) {
            if ($product->category->parent_id && $product->category->parent) {
                $relatedCategoryIds = $product->category->parent->children->pluck('id')->push($product->category->parent->id)->all();
            } else {
                $relatedCategoryIds = $product->category->children->pluck('id')->push($product->category->id)->all();
            }
        }

        $relatedProducts = $this->products()
            ->with('category.parent')
            ->whereKeyNot($product->id)
            ->when(!empty($relatedCategoryIds), fn ($query) => $query->whereIn('category_id', $relatedCategoryIds))
            ->latest('id')
            ->limit(4)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = $this->products()
                ->with('category.parent')
                ->whereKeyNot($product->id)
                ->latest('id')
                ->limit(4)
                ->get();
        }

        $requiresAgeVerification = $product->category ? $product->category->requiresAgeVerification() : false;

        return view('frontend.products.show', [
            'frontendData' => $frontendData,
            'categories' => $this->productCategories(),
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'requiresAgeVerification' => $requiresAgeVerification,
        ]);
    }

    public static function imageUrl(?string $path, string $fallback = 'image/Rectangle 11.png'): string
    {
        $path = trim((string) $path);

        if ($path === '' || $path === 'storage' || $path === 'storage/' || $path === '/') {
            $path = $fallback;
        }

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

        // Hỗ trợ cả slug cha lẫn slug con: ưu tiên dùng slug cha nếu có để URL chuẩn SEO
        $category = ($product->category->parent_id && $product->category->parent)
            ? $product->category->parent
            : $product->category;

        $locale = \Illuminate\Support\Facades\App::getLocale();
        $categorySlug = \App\Helpers\SlugHelper::translate($category->slug, $locale);
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
            ->whereNull('parent_id')
            ->whereNotIn('slug', ['bo', 'giong-bo-vacamaxi'])
            ->withCount(['products' => fn (Builder $query) => $query->where('is_active', true)])
            ->with(['children' => fn ($query) => $query->where('is_active', true)->withCount(['products' => fn ($q) => $q->where('is_active', true)])->orderBy('sort_order')->orderBy('name')])
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
