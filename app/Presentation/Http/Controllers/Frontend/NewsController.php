<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $frontendData = $this->frontendData();

        $posts = $this->publishedPosts()
            ->with('category')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('frontend.news-index', [
            'frontendData' => $frontendData,
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

    private function frontendData(): array
    {
        $path = resource_path('data/frontend.json');

        if (! is_file($path)) {
            return [];
        }

        return json_decode(file_get_contents($path), true) ?: [];
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
