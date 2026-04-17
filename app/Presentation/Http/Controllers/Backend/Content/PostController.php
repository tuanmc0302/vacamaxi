<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->string('keyword'));
        $categoryId = $request->integer('category_id') ?: null;

        return view('backend.content.posts.index', [
            'posts' => Post::query()
                ->with(['category', 'author'])
                ->when($keyword !== '', fn ($query) => $query->where('title', 'like', "%{$keyword}%"))
                ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->paginate(20)
                ->withQueryString(),
            'categories' => $this->categories(),
            'filters' => ['keyword' => $keyword, 'category_id' => $categoryId],
        ]);
    }

    public function create(): View
    {
        return view('backend.content.posts.form', [
            'post' => new Post(['is_active' => true, 'published_at' => now()]),
            'categories' => $this->categories(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $validated['author_id'] = $request->user()?->id;

        Post::query()->create($validated);

        return redirect()->route('admin.posts.index')->with('status', 'Đã tạo bài viết.');
    }

    public function edit(Post $post): View
    {
        return view('backend.content.posts.form', [
            'post' => $post,
            'categories' => $this->categories(),
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $post->update($this->validated($request, $post));

        return redirect()->route('admin.posts.index')->with('status', 'Đã cập nhật bài viết.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Đã xóa bài viết.');
    }

    private function validated(Request $request, ?Post $post = null): array
    {
        $slug = $request->filled('slug') ? Str::slug((string) $request->string('slug')) : Str::slug((string) $request->string('title'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts')->ignore($post?->id)],
            'image' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }

    private function categories()
    {
        return Category::query()
            ->where('module', Category::MODULE_NEWS)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
