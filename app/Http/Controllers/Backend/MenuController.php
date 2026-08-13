<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $menuItems = MenuItem::query()
            ->with('children.children')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('backend.management.menu.index', compact('menuItems'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'label_en' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'url_en' => ['nullable', 'string', 'max:255'],
            'key' => ['nullable', 'string', 'max:80'],
            'parent_id' => ['nullable', 'integer', 'exists:menu_items,id'],
            'target' => ['nullable', Rule::in(['_self', '_blank'])],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $parentId = $validated['parent_id'] ?? null;
        $maxOrder = MenuItem::query()->where('parent_id', $parentId)->max('sort_order') ?? -1;

        $menuItem = MenuItem::query()->create([
            'label' => $validated['label'],
            'label_en' => $validated['label_en'] ?? null,
            'url' => $validated['url'] ?? '#',
            'url_en' => $validated['url_en'] ?? null,
            'key' => $validated['key'] ?? null,
            'parent_id' => $parentId,
            'target' => $validated['target'] ?? '_self',
            'is_active' => (bool) ($validated['is_active'] ?? true),
            'sort_order' => $maxOrder + 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm mục menu mới.',
            'item' => $menuItem,
        ]);
    }

    public function update(Request $request, MenuItem $menuItem): JsonResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'label_en' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'url_en' => ['nullable', 'string', 'max:255'],
            'key' => ['nullable', 'string', 'max:80'],
            'target' => ['nullable', Rule::in(['_self', '_blank'])],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $menuItem->update([
            'label' => $validated['label'],
            'label_en' => $validated['label_en'] ?? null,
            'url' => $validated['url'] ?? '#',
            'url_en' => $validated['url_en'] ?? null,
            'key' => $validated['key'] ?? null,
            'target' => $validated['target'] ?? '_self',
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đã cập nhật mục menu.',
            'item' => $menuItem,
        ]);
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => ['required_without:order', 'array'],
            'items.*.id' => ['required_with:items', 'integer', 'exists:menu_items,id'],
            'items.*.children' => ['nullable', 'array'],
            'order' => ['required_without:items', 'array'],
            'order.*.id' => ['required_with:order', 'integer', 'exists:menu_items,id'],
            'order.*.parent_id' => ['nullable', 'integer', 'exists:menu_items,id'],
            'order.*.sort_order' => ['required_with:order', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($validated) {
            if (isset($validated['items'])) {
                $this->persistTree($validated['items']);

                return;
            }

            foreach ($validated['order'] as $item) {
                MenuItem::query()
                    ->whereKey($item['id'])
                    ->update([
                        'parent_id' => $item['parent_id'] ?? null,
                        'sort_order' => $item['sort_order'],
                    ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Đã cập nhật thứ tự menu.',
        ]);
    }

    public function destroy(MenuItem $menuItem): JsonResponse
    {
        $menuItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa mục menu.',
        ]);
    }

    private function persistTree(array $items, ?int $parentId = null): void
    {
        foreach (array_values($items) as $index => $item) {
            $id = (int) $item['id'];

            if ($id === $parentId) {
                continue;
            }

            MenuItem::query()
                ->whereKey($id)
                ->update([
                    'parent_id' => $parentId,
                    'sort_order' => $index,
                ]);

            $children = $item['children'] ?? [];

            if (is_array($children) && $children !== []) {
                $this->persistTree($children, $id);
            }
        }
    }
}
