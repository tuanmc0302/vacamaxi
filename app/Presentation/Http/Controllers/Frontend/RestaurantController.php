<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FrontendWidget;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class RestaurantController extends Controller
{
    private const WIDGET_KEYS = [
        'restaurant_page_hero',
        'restaurant_page_intro',
        'restaurant_page_banner',
        'restaurant_page_gallery',
        'restaurant_product_one',
        'restaurant_product_two',
    ];

    private const DEFAULT_WIDGETS = [
        'restaurant_page_hero' => [
            'title' => 'Dịch vụ - Nhà hàng',
            'sub_title' => 'Trang chủ / Dịch vụ nhà hàng',
            'description' => 'Không gian steak & grill cao cấp của VACA MAXI.',
            'settings' => ['images' => ['/image/banner.png']],
            'sort_order' => 10,
        ],
        'restaurant_page_intro' => [
            'title' => 'Nhà hàng Vaca Maxi',
            'sub_title' => null,
            'description' => 'VACA MAXI là nhà hàng steak & grill cao cấp, nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của câu chuyện phía sau mỗi lựa chọn. Nhà hàng được hình thành từ một tư duy khác về trải nghiệm ăn uống: một bữa ăn thực sự trọn vẹn khi nguyên liệu có nền tảng, rượu có độ lên men và không gian đủ tinh tế để mọi cảm xúc được dẫn dắt một cách tự nhiên.',
            'settings' => [
                'button_text' => 'Tìm hiểu thêm',
                'button_url' => '#restaurant-banner',
                'images' => ['/image/Rectangle 5.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png'],
            ],
            'sort_order' => 20,
        ],
        'restaurant_page_banner' => [
            'title' => 'VACA MAXI là nhà hàng steak & grill cao cấp',
            'sub_title' => 'Nhà hàng 5 sao Vaca Maxi',
            'description' => 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của câu chuyện phía sau mỗi lựa chọn.',
            'settings' => ['button_text' => 'Khám phá ngay', 'button_url' => '#restaurant-products', 'images' => ['/image/banner.png']],
            'sort_order' => 30,
        ],
        'restaurant_page_gallery' => [
            'title' => 'Nhà hàng 5 sao Vaca Maxi',
            'sub_title' => null,
            'description' => 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của câu chuyện phía sau mỗi lựa chọn.',
            'settings' => ['images' => ['/image/Rectangle 5.png', '/image/Rectangle 11.png', '/image/Rectangle 2.png', '/image/Rectangle 3.png']],
            'sort_order' => 40,
        ],
        'restaurant_product_one' => [
            'title' => 'Rượu Vaca Maxi',
            'sub_title' => null,
            'description' => 'Các sản phẩm rượu mới nhất tại VACA MAXI.',
            'settings' => ['button_text' => 'Xem thêm', 'button_url' => '/san-pham/ruou', 'category_slug' => 'ruou'],
            'sort_order' => 50,
        ],
        'restaurant_product_two' => [
            'title' => 'Thịt bò Vaca Maxi',
            'sub_title' => null,
            'description' => 'Các sản phẩm thịt bò mới nhất tại VACA MAXI.',
            'settings' => ['button_text' => 'Xem thêm', 'button_url' => '/san-pham/thit-bo', 'category_slug' => 'thit-bo'],
            'sort_order' => 60,
        ],
    ];

    public function __invoke(): View
    {
        return view('frontend.restaurant', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgets(),
            'productResolver' => fn ($widget) => $this->productsForWidget($widget),
        ]);
    }

    private function widgets(): Collection
    {
        try {
            $this->ensureWidgets();

            $widgets = FrontendWidget::query()
                ->where('is_active', true)
                ->whereIn('key', self::WIDGET_KEYS)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();

            if ($widgets->isNotEmpty()) {
                return $widgets;
            }
        } catch (Throwable) {
            //
        }

        return collect(self::DEFAULT_WIDGETS)
            ->map(fn (array $widget, string $key) => (object) (['key' => $key, 'is_active' => true] + $widget))
            ->sortBy('sort_order')
            ->values();
    }

    private function ensureWidgets(): void
    {
        foreach (self::DEFAULT_WIDGETS as $key => $widget) {
            FrontendWidget::query()->firstOrCreate(
                ['key' => $key],
                $widget + ['is_active' => true]
            );
        }
    }

    private function productsForWidget($widget): Collection
    {
        try {
            $categoryId = data_get($widget, 'settings.category_id');
            $categorySlug = data_get($widget, 'settings.category_slug');

            $category = Category::query()
                ->where('module', Category::MODULE_PRODUCT)
                ->where('is_active', true)
                ->when($categoryId, fn (Builder $query) => $query->whereKey($categoryId))
                ->when(! $categoryId && $categorySlug, fn (Builder $query) => $query->where('slug', $categorySlug))
                ->first();

            if (! $category) {
                return new Collection();
            }

            return Product::query()
                ->with('category')
                ->where('is_active', true)
                ->where('category_id', $category->id)
                ->latest('id')
                ->take(4)
                ->get();
        } catch (Throwable) {
            return new Collection();
        }
    }

    private function frontendData(): array
    {
        $path = resource_path('data/frontend.json');
        $frontendData = is_file($path) ? (json_decode(file_get_contents($path), true) ?: []) : [];

        foreach ($frontendData['nav'] ?? [] as &$item) {
            if (($item['key'] ?? '') === 'restaurant') {
                $item['url'] = route('frontend.restaurant');
            }
        }

        return $frontendData;
    }
}
