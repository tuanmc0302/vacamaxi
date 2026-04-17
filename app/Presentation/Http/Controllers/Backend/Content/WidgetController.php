<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FrontendWidget;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WidgetController extends Controller
{
    private const IMAGE_CONFIG_WIDGET_KEYS = [
        'about_me_home',
        'about_team_home',
        'about_restaurant_home',
    ];

    public function index(): View
    {
        return view('backend.content.widgets.index', [
            'widgets' => FrontendWidget::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function edit(FrontendWidget $widget): View
    {
        return view('backend.content.widgets.edit', [
            'widget' => $widget,
            'productCategories' => Category::query()
                ->where('module', Category::MODULE_PRODUCT)
                ->where('is_active', true)
                ->withCount('products')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function update(Request $request, FrontendWidget $widget): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'sub_title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'feedback_items' => ['nullable', 'array', 'max:10'],
            'feedback_items.*.avatar' => ['nullable', 'string', 'max:255'],
            'feedback_items.*.role' => ['nullable', 'string', 'max:80'],
            'feedback_items.*.name' => ['nullable', 'string', 'max:120'],
            'feedback_items.*.content' => ['nullable', 'string', 'max:500'],
            'widget_images' => ['nullable', 'array', 'max:4'],
            'widget_images.*' => ['nullable', 'string', 'max:255'],
        ]);

        $settings = $widget->settings ?? [];

        if (Str::startsWith($widget->key, 'product_option_')) {
            $settings['category_id'] = $validated['category_id'] ?? null;
        }

        if ($widget->key === 'feedback_home') {
            $settings['items'] = $this->feedbackItems($validated['feedback_items'] ?? []);
        }

        if (in_array($widget->key, self::IMAGE_CONFIG_WIDGET_KEYS, true)) {
            $settings['images'] = $this->widgetImages($validated['widget_images'] ?? []);
        }

        $widget->update([
            'title' => $validated['title'] ?? null,
            'sub_title' => $validated['sub_title'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active'),
            'settings' => $settings,
        ]);

        return redirect()->route('admin.widgets.index')->with('status', 'Đã cập nhật widget trang chủ.');
    }

    private function widgetImages(array $images): array
    {
        return collect($images)
            ->take(4)
            ->map(fn ($image): string => trim((string) $image))
            ->filter()
            ->values()
            ->all();
    }

    private function feedbackItems(array $items): array
    {
        return collect($items)
            ->take(10)
            ->map(fn (array $item): array => [
                'avatar' => trim($item['avatar'] ?? '') ?: '/image/Rectangle 2.png',
                'role' => trim($item['role'] ?? '') ?: 'Khách hàng',
                'name' => trim($item['name'] ?? ''),
                'content' => trim($item['content'] ?? ''),
            ])
            ->filter(fn (array $item): bool => $item['name'] !== '' || $item['content'] !== '')
            ->values()
            ->all();
    }

    public function toggle(Request $request, FrontendWidget $widget): JsonResponse
    {
        $validated = $request->validate([
            'is_active' => ['required', 'boolean'],
        ]);

        $widget->update(['is_active' => (bool) $validated['is_active']]);

        return response()->json([
            'message' => 'Đã cập nhật trạng thái widget.',
            'is_active' => $widget->is_active,
        ]);
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'widgets' => ['required', 'array'],
            'widgets.*' => ['integer', 'exists:frontend_widgets,id'],
        ]);

        foreach ($validated['widgets'] as $index => $widgetId) {
            FrontendWidget::query()
                ->whereKey($widgetId)
                ->update(['sort_order' => $index + 1]);
        }

        return response()->json(['message' => 'Đã cập nhật thứ tự widget.']);
    }
}
