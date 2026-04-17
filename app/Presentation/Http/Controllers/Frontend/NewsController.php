<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class NewsController extends Controller
{
    public function index(): View
    {
        $frontendData = $this->frontendData();
        $categories = $this->newsCategories();

        $firstCategoryId = $categories->first()?->id;
        $postsByCategory = $categories->mapWithKeys(fn (Category $category): array => [
            $category->id => $this->postsForCategory($category->id, $firstCategoryId)
                ->with('category')
                ->orderByDesc('published_at')
                ->orderByDesc('id')
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
        $category = $this->newsCategories()->firstWhere('slug', $categorySlug) ?? abort(404);

        $posts = $this->postsForCategory($category->id, $this->newsCategories()->first()?->id)
            ->with('category')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
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

        $post = $this->publishedPosts()
            ->with(['category', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = $this->publishedPosts()
            ->with('category')
            ->whereKeyNot($post->getKey())
            ->when($post->category_id, fn (Builder $query) => $query->where('category_id', $post->category_id))
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = $this->publishedPosts()
                ->with('category')
                ->whereKeyNot($post->getKey())
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->limit(4)
                ->get();
        }

        return view('frontend.news-detail', [
            'frontendData' => $frontendData,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    private function publishedPosts(): Builder
    {
        return Post::query()
            ->where('is_active', true)
            ->where(function (Builder $query): void {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    private function postsForCategory(int $categoryId, ?int $firstCategoryId): Builder
    {
        return $this->publishedPosts()
            ->where(function (Builder $query) use ($categoryId, $firstCategoryId): void {
                $query->where('category_id', $categoryId);

                if ($firstCategoryId === $categoryId) {
                    $query->orWhereNull('category_id');
                }
            });
    }

    private function newsCategories(): Collection
    {
        return Category::query()
            ->where('module', Category::MODULE_NEWS)
            ->where('is_active', true)
            ->withCount(['posts' => function (Builder $query): void {
                $this->publishedPostsConstraint($query);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    private function publishedPostsConstraint(Builder $query): void
    {
        $query->where('is_active', true)
            ->where(function (Builder $subQuery): void {
                $subQuery->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    private function frontendData(): array
    {
        $path = resource_path('data/frontend.json');

        if (! is_file($path)) {
            return [];
        }

        $frontendData = json_decode(file_get_contents($path), true) ?: [];
        $frontendData['nav'] = $this->withNewsNav($frontendData['nav'] ?? []);

        return $frontendData;
    }

    private function withNewsNav(array $nav): array
    {
        try {
            $children = $this->newsCategories()
                ->map(fn (Category $category): array => [
                    'label' => $category->name,
                    'url' => route('frontend.news.category', $category->slug),
                    'key' => 'news-' . $category->slug,
                ])
                ->values()
                ->all();
        } catch (Throwable) {
            return $nav;
        }

        foreach ($nav as &$item) {
            if (($item['key'] ?? '') === 'news') {
                $item['url'] = route('frontend.news.index');
                $item['children'] = $children;
            }
        }

        return $nav;
    }

    public static function imageUrl(?string $path, string $fallback = 'image/Rectangle 5.png'): string
    {
        $path = $path ?: $fallback;

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        return asset($path);
    }
}
