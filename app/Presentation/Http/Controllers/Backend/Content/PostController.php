<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
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

    public function uploadEditorImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'upload' => ['required', 'image', 'max:5120'],
        ]);

        $path = $this->storeImage($validated['upload'], 'posts/editor');

        return response()->json([
            'uploaded' => true,
            'fileName' => basename($path),
            'url' => '/storage/' . $path,
        ]);
    }

    private function validated(Request $request, ?Post $post = null): array
    {
        $slug = $request->filled('slug')
            ? Str::slug((string) $request->string('slug'))
            : Str::slug((string) $request->string('title'));

        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts')->ignore($post?->id)],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_title_en' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'seo_description_en' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        unset($validated['image_file']);

        if ($request->hasFile('image_file')) {
            $path = $this->storeImage($request->file('image_file'), 'posts');
            $validated['image'] = 'storage/' . $path;
        } elseif (! $post) {
            $validated['image'] = null;
        }

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

    private function storeImage($file, string $directory): string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $safeName = Str::slug($originalName) ?: 'image';
        $filename = $safeName . '-' . now()->format('YmdHis') . '-' . Str::lower(Str::random(6)) . '.' . $extension;

        return $file->storeAs($directory, $filename, 'public');
    }
}
