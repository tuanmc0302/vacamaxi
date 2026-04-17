<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->string('keyword'));
        $categoryId = $request->integer('category_id') ?: null;

        return view('backend.content.products.index', [
            'products' => Product::query()
                ->with('category')
                ->when($keyword !== '', fn ($query) => $query->where('name', 'like', "%{$keyword}%"))
                ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
                ->orderBy('sort_order')
                ->orderByDesc('id')
                ->paginate(20)
                ->withQueryString(),
            'categories' => $this->categories(),
            'filters' => ['keyword' => $keyword, 'category_id' => $categoryId],
        ]);
    }

    public function create(): View
    {
        return view('backend.content.products.form', [
            'product' => new Product(['is_active' => true, 'sort_order' => 0]),
            'categories' => $this->categories(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Product::query()->create($this->validated($request));

        return redirect()->route('admin.products.index')->with('status', 'Đã tạo sản phẩm.');
    }

    public function edit(Product $product): View
    {
        return view('backend.content.products.form', [
            'product' => $product,
            'categories' => $this->categories(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($this->validated($request, $product));

        return redirect()->route('admin.products.index')->with('status', 'Đã cập nhật sản phẩm.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Đã xóa sản phẩm.');
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $slug = $request->filled('slug') ? Str::slug((string) $request->string('slug')) : Str::slug((string) $request->string('name'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product?->id)],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        unset($validated['image_file']);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $validated['image'] = 'storage/' . $path;
        } elseif (! $product) {
            $validated['image'] = null;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        return $validated;
    }

    private function categories()
    {
        return Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}