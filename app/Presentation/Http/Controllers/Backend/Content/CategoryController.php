<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $module = $this->module($request);
        $keyword = trim((string) $request->string('keyword'));

        return view('backend.content.categories.index', [
            'module' => $module,
            'categories' => Category::query()
                ->where('module', $module)
                ->with('parent')
                ->when($keyword !== '', fn ($query) => $query->where('name', 'like', "%{$keyword}%"))
                ->orderBy('sort_order')
                ->orderByDesc('id')
                ->paginate(20)
                ->withQueryString(),
            'filters' => ['keyword' => $keyword],
        ]);
    }

    public function create(Request $request): View
    {
        $module = $this->module($request);

        return view('backend.content.categories.form', [
            'module' => $module,
            'category' => new Category(['is_active' => true, 'sort_order' => 0]),
            'parentCategories' => Category::query()
                ->where('module', $module)
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $module = $this->module($request);
        $validated = $this->validated($request, $module);
        $validated['module'] = $module;

        Category::query()->create($validated);

        return redirect()->route($this->indexRoute($module))->with('status', 'Đã tạo danh mục.');
    }

    public function edit(Request $request, Category $category): View
    {
        $module = $this->module($request);
        abort_if($category->module !== $module, 404);

        return view('backend.content.categories.form', [
            'module' => $module,
            'category' => $category,
            'parentCategories' => Category::query()
                ->where('module', $module)
                ->where('id', '!=', $category->id)
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $module = $this->module($request);
        abort_if($category->module !== $module, 404);

        $category->update($this->validated($request, $module, $category));

        return redirect()->route($this->indexRoute($module))->with('status', 'Đã cập nhật danh mục.');
    }

    public function destroy(Request $request, Category $category): RedirectResponse
    {
        $module = $this->module($request);
        abort_if($category->module !== $module, 404);

        $category->delete();

        return redirect()->route($this->indexRoute($module))->with('status', 'Đã xóa danh mục.');
    }

    private function validated(Request $request, string $module, ?Category $category = null): array
    {
        $slug = $request->filled('slug') ? Str::slug((string) $request->string('slug')) : Str::slug((string) $request->string('name'));
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'parent_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where('module', $module),
                function ($attribute, $value, $fail) use ($category) {
                    if ($category && (int) $value === (int) $category->id) {
                        $fail('Danh mục cha không thể là chính nó.');
                    }
                },
            ],
            'name' => ['required', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where('module', $module)->ignore($category?->id),
            ],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['parent_id'] = $request->filled('parent_id') ? (int) $request->input('parent_id') : null;
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);

        return $validated;
    }

    private function module(Request $request): string
    {
        $module = (string) $request->route('module', Category::MODULE_PRODUCT);
        abort_unless(in_array($module, [Category::MODULE_PRODUCT, Category::MODULE_NEWS], true), 404);

        return $module;
    }

    private function indexRoute(string $module): string
    {
        return $module === Category::MODULE_NEWS ? 'admin.news-categories.index' : 'admin.product-categories.index';
    }
}
