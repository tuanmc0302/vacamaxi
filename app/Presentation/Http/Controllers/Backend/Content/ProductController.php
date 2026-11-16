<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
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

        $selectedCategoryIds = null;
        if ($categoryId) {
            $cat = Category::query()->with('children')->find($categoryId);
            $selectedCategoryIds = $cat ? $cat->children->pluck('id')->push($cat->id)->all() : [$categoryId];
        }

        return view('backend.content.products.index', [
            'products' => Product::query()
                ->with('category')
                ->when($keyword !== '', fn ($query) => $query->where('name', 'like', "%{$keyword}%"))
                ->when($selectedCategoryIds, fn ($query) => $query->whereIn('category_id', $selectedCategoryIds))
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

    public function uploadEditorImage(Request $request): JsonResponse
    {
        if (! $request->hasFile('upload') || ! $request->file('upload')->isValid()) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => 'Tải lên hình ảnh không thành công hoặc file không hợp lệ.',
                ],
            ]);
        }

        $file = $request->file('upload');
        $validator = validator(['upload' => $file], [
            'upload' => ['image', 'max:10240'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'uploaded' => 0,
                'error' => [
                    'message' => $validator->errors()->first('upload'),
                ],
            ]);
        }

        $path = $file->store('products', 'public');
        $url = asset('storage/' . $path);

        return response()->json([
            'uploaded' => 1,
            'fileName' => $file->getClientOriginalName(),
            'url' => $url,
            'default' => $url,
        ]);
    }

    private function validated(Request $request, ?Product $product = null): array
    {
        $slug = $request->filled('slug') ? Str::slug((string) $request->string('slug')) : Str::slug((string) $request->string('name'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'subtitle_en' => ['nullable', 'string', 'max:255'],
            'attributes' => ['nullable'],
            'attributes_json' => ['nullable', 'string'],
            'attributes_en' => ['nullable'],
            'attributes_en_json' => ['nullable', 'string'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product?->id)],
            'image_file' => ['nullable', 'image', 'max:10240'],
            'gallery_files' => ['nullable', 'array'],
            'gallery_files.*' => ['nullable', 'image', 'max:10240'],
            'short_description' => ['nullable', 'string'],
            'short_description_en' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_title_en' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'seo_description_en' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        unset($validated['image_file']);
        unset($validated['gallery_files']);
        unset($validated['attributes_json']);
        unset($validated['attributes_en_json']);

        if ($request->hasFile('image_file') && $request->file('image_file')->isValid()) {
            $path = $request->file('image_file')->store('products', 'public');
            if (! empty($path)) {
                $validated['image'] = 'storage/' . $path;
            }
        } elseif (! $product) {
            $validated['image'] = null;
        }

        $existingGallery = $request->input('existing_gallery', []);
        if (! is_array($existingGallery)) {
            $existingGallery = [];
        }
        $existingGallery = array_values(array_filter($existingGallery, function ($img) {
            $img = trim((string) $img);
            return $img !== '' && $img !== 'storage' && $img !== 'storage/' && $img !== '/';
        }));

        $newGallery = [];
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                if ($file && $file->isValid()) {
                    // Store in 'products' directory to avoid permission issues when creating nested subdirectories
                    $path = $file->store('products', 'public');
                    if (! empty($path)) {
                        $newGallery[] = 'storage/' . $path;
                    }
                }
            }
        }

        if ($product) {
            if ($request->has('existing_gallery') || $request->hasFile('gallery_files')) {
                $validated['gallery'] = array_values(array_merge($existingGallery, $newGallery));
            }
        } else {
            $validated['gallery'] = $newGallery;
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        // Xử lý subtitle
        $validated['subtitle'] = $request->filled('subtitle') ? trim((string) $request->input('subtitle')) : null;
        $validated['subtitle_en'] = $request->filled('subtitle_en') ? trim((string) $request->input('subtitle_en')) : null;

        // Xử lý attributes (VI)
        if ($request->filled('attributes_json')) {
            $decoded = json_decode((string) $request->input('attributes_json'), true);
            $validated['attributes'] = is_array($decoded) ? $decoded : null;
        } elseif ($request->has('attribute_keys') && is_array($request->input('attribute_keys'))) {
            $keys = $request->input('attribute_keys', []);
            $values = $request->input('attribute_values', []);
            $attrs = [];
            foreach ($keys as $i => $k) {
                $trimmedKey = trim((string) $k);
                $trimmedVal = trim((string) ($values[$i] ?? ''));
                if ($trimmedKey !== '') {
                    $attrs[$trimmedKey] = $trimmedVal;
                }
            }
            $validated['attributes'] = !empty($attrs) ? $attrs : null;
        } elseif ($request->has('attributes')) {
            $rawAttrs = $request->input('attributes');
            if (is_string($rawAttrs)) {
                $decoded = json_decode($rawAttrs, true);
                $validated['attributes'] = is_array($decoded) ? $decoded : null;
            } elseif (is_array($rawAttrs)) {
                $validated['attributes'] = $rawAttrs;
            }
        }

        // Xử lý attributes_en (EN)
        if ($request->filled('attributes_en_json')) {
            $decodedEn = json_decode((string) $request->input('attributes_en_json'), true);
            $validated['attributes_en'] = is_array($decodedEn) ? $decodedEn : null;
        } elseif ($request->has('attribute_keys_en') && is_array($request->input('attribute_keys_en'))) {
            $keysEn = $request->input('attribute_keys_en', []);
            $valuesEn = $request->input('attribute_values_en', []);
            $attrsEn = [];
            foreach ($keysEn as $i => $k) {
                $trimmedKey = trim((string) $k);
                $trimmedVal = trim((string) ($valuesEn[$i] ?? ''));
                if ($trimmedKey !== '') {
                    $attrsEn[$trimmedKey] = $trimmedVal;
                }
            }
            $validated['attributes_en'] = !empty($attrsEn) ? $attrsEn : null;
        } elseif ($request->has('attributes_en')) {
            $rawAttrsEn = $request->input('attributes_en');
            if (is_string($rawAttrsEn)) {
                $decodedEn = json_decode($rawAttrsEn, true);
                $validated['attributes_en'] = is_array($decodedEn) ? $decodedEn : null;
            } elseif (is_array($rawAttrsEn)) {
                $validated['attributes_en'] = $rawAttrsEn;
            }
        }

        return $validated;
    }

    private function categories()
    {
        return Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}