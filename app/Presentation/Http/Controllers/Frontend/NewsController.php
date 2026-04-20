<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\MenuService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function __construct(
        private readonly MenuService $menuService
    ) {}

    public function index(): View
    {
        $frontendData = $this->frontendData();
        $categories = $this->newsCategories();

        $postsByCategory = $categories->mapWithKeys(fn (Category $category): array => [
            $category->id => Post::query()
                ->where('category_id', $category->id)
                ->where('is_active', true)
                ->with('category')
                ->orderByDesc('published_at')
                ->limit(8)
                ->get(),
        ]);

        return view('frontend.news-index', [
            'frontendData' => $frontendData,
            'categories' => $categories,
            'postsByCategory' => $postsByCategory,
        ]);
    }

    public function category(string $categorySlug): View
    {
        $frontendData = $this->frontendData();
        $category = Category::where('slug', $categorySlug)->where('module', 'news')->firstOrFail();

        $posts = Post::query()
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->with('category')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('frontend.news-category', [
            'frontendData' => $frontendData,
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function show(string $slug): View
    {
        $frontendData = $this->frontendData();
        $post = Post::where('slug', $slug)->where('is_active', true)->with(['category', 'author'])->firstOrFail();

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_active', true)
            ->orderByDesc('published_at')
            ->limit(4)
            ->get();

        return view('frontend.news-detail', [
            'frontendData' => $frontendData,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    private function newsCategories(): Collection
    {
        return Category::where('module', 'news')->where('is_active', true)->orderBy('sort_order')->get();
    }

    private function frontendData(): array
    {
        $path = resource_path('data/frontend.json');
        $frontendData = File::exists($path) ? json_decode(File::get($path), true) : [];
        $frontendData['nav'] = $this->menuService->getFrontendMenu();
        return $frontendData;
    }

    public static function imageUrl(?string $path, string $fallback = 'image/Rectangle 5.png'): string
    {
        if (!$path) return asset($fallback);

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        return asset('storage/' . $path);
    }
}
