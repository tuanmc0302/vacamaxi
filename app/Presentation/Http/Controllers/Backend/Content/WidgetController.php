<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FrontendWidget;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WidgetController extends Controller
{
    private const PAGE_WIDGET_GROUPS = [
        'home' => [
            'banner_home',
            'about_me_home',
            'product_option_one',
            'about_team_home',
            'product_option_two',
            'product_option_three',
            'about_restaurant_home',
            'feedback_home',
            'news_home',
        ],
        'about' => [
            'about_page_hero',
            'about_page_intro',
            'about_page_values',
            'about_page_experts',
            'about_page_farm',
            'about_page_cta',
        ],
        'about-scale' => [
            'about_scale_page_hero',
            'about_scale_page_farm',
            'about_scale_page_experts',
            'about_scale_page_care',
            'about_scale_page_biotech',
            'about_scale_page_ivf',
            'about_scale_page_strategy',
            'about_scale_page_cta',
        ],
        'restaurant' => [
            'restaurant_page_hero',
            'restaurant_page_intro',
            'restaurant_page_banner',
            'restaurant_page_gallery',
            'restaurant_product_one',
            'restaurant_product_two',
        ],
    ];

    private const IMAGE_CONFIG_WIDGETS = [
        'about_me_home' => 4,
        'about_team_home' => 4,
        'about_restaurant_home' => 4,
        'about_page_hero' => 1,
        'about_page_intro' => 4,
        'about_page_values' => 1,
        'about_page_experts' => 1,
        'about_page_farm' => 1,
        'about_scale_page_hero' => 1,
        'about_scale_page_farm' => 1,
        'about_scale_page_experts' => 8,
        'about_scale_page_care' => 1,
        'about_scale_page_biotech' => 1,
        'about_scale_page_ivf' => 1,
        'about_scale_page_strategy' => 2,
        'restaurant_page_hero' => 1,
        'restaurant_page_intro' => 4,
        'restaurant_page_banner' => 1,
        'restaurant_page_gallery' => 4,
    ];

    private const DEFAULT_RESTAURANT_WIDGETS = [
        'restaurant_page_hero' => [
            'title' => 'Dịch vụ - Nhà hàng',
            'sub_title' => 'Trang chủ / Dịch vụ nhà hàng',
            'description' => 'Không gian steak & grill cao cấp của VACAMAXI.',
            'settings' => ['images' => ['/image/banner.png']],
            'sort_order' => 10,
        ],
        'restaurant_page_intro' => [
            'title' => 'Nhà hàng VACAMAXI',
            'sub_title' => null,
            'description' => 'VACAMAXI là nhà hàng steak & grill cao cấp, nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của câu chuyện phía sau mỗi lựa chọn. Nhà hàng được hình thành từ một tư duy khác về trải nghiệm ăn uống: một bữa ăn thực sự trọn vẹn khi nguyên liệu có nền tảng, rượu có độ lên men và không gian đủ tinh tế để mọi cảm xúc được dẫn dắt một cách tự nhiên.',
            'settings' => [
                'button_text' => 'Tìm hiểu thêm',
                'button_url' => '#restaurant-banner',
                'images' => ['/image/Rectangle 5.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png'],
            ],
            'sort_order' => 20,
        ],
        'restaurant_page_banner' => [
            'title' => 'VACAMAXI là nhà hàng steak & grill cao cấp',
            'sub_title' => 'Nhà hàng 5 sao VACAMAXI',
            'description' => 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của câu chuyện phía sau mỗi lựa chọn.',
            'settings' => ['button_text' => 'Khám phá ngay', 'button_url' => '#restaurant-products', 'images' => ['/image/banner.png']],
            'sort_order' => 30,
        ],
        'restaurant_page_gallery' => [
            'title' => 'Nhà hàng 5 sao VACAMAXI',
            'sub_title' => null,
            'description' => 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của câu chuyện phía sau mỗi lựa chọn.',
            'settings' => ['images' => ['/image/Rectangle 5.png', '/image/Rectangle 11.png', '/image/Rectangle 2.png', '/image/Rectangle 3.png']],
            'sort_order' => 40,
        ],
        'restaurant_product_one' => [
            'title' => 'Rượu VACAMAXI',
            'sub_title' => null,
            'description' => 'Các sản phẩm rượu mới nhất tại VACAMAXI.',
            'settings' => ['button_text' => 'Xem thêm', 'button_url' => '/san-pham/ruou', 'category_slug' => 'ruou'],
            'sort_order' => 50,
        ],
        'restaurant_product_two' => [
            'title' => 'Thịt bò VACAMAXI',
            'sub_title' => null,
            'description' => 'Các sản phẩm thịt bò mới nhất tại VACAMAXI.',
            'settings' => ['button_text' => 'Xem thêm', 'button_url' => '/san-pham/thit-bo', 'category_slug' => 'thit-bo'],
            'sort_order' => 60,
        ],
    ];

    public function index(): View
    {
        $page = request()->query('page', 'home');
        $this->ensurePageWidgets($page);
        $pageKeys = $this->pageKeys($page);

        return view('backend.content.widgets.index', [
            'widgets' => FrontendWidget::query()
                ->whereIn('key', $pageKeys)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(),
            'currentPage' => $page,
        ]);
    }

    public function edit(FrontendWidget $widget): View
    {
        $page = request()->query('page', $this->pageByWidgetKey($widget->key));

        return view('backend.content.widgets.edit', [
            'widget' => $widget,
            'currentPage' => $page,
            'imageConfigCount' => $this->imageConfigCount($widget->key),
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
        $this->validateWidgetUploadErrors($request);

        $page = (string) $request->input('page', $this->pageByWidgetKey($widget->key));
        $validated = $request->validate([
            'page' => ['nullable', 'string'],
            'title' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'sub_title' => ['nullable', 'string', 'max:255'],
            'sub_title_en' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_text_en' => ['nullable', 'string', 'max:255'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'button_url_en' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'setting_fields' => ['nullable', 'array'],
            'setting_fields.*' => ['nullable', 'string', 'max:255'],
            'setting_fields_en' => ['nullable', 'array'],
            'setting_fields_en.*' => ['nullable', 'string', 'max:255'],
            'feedback_items' => ['nullable', 'array', 'max:10'],
            'feedback_items.*.avatar' => ['nullable', 'string', 'max:255'],
            'feedback_items.*.role' => ['nullable', 'string', 'max:80'],
            'feedback_items.*.name' => ['nullable', 'string', 'max:120'],
            'feedback_items.*.content' => ['nullable', 'string', 'max:500'],
            'feedback_items_en' => ['nullable', 'array', 'max:10'],
            'feedback_items_en.*.avatar' => ['nullable', 'string', 'max:255'],
            'feedback_items_en.*.role' => ['nullable', 'string', 'max:80'],
            'feedback_items_en.*.name' => ['nullable', 'string', 'max:120'],
            'feedback_items_en.*.content' => ['nullable', 'string', 'max:500'],
            'widget_images' => ['nullable', 'array', 'max:' . max($this->imageConfigCount($widget->key), 1)],
            'widget_images.*' => ['nullable', 'string', 'max:255'],
            'widget_image_files' => ['nullable', 'array', 'max:' . max($this->imageConfigCount($widget->key), 1)],
            'widget_image_files.*' => ['nullable', 'image', 'max:40960'],
            'banner_slides' => ['nullable', 'array', 'max:10'],
            'banner_slides.*.title' => ['nullable', 'string', 'max:255'],
            'banner_slides.*.sub_title' => ['nullable', 'string', 'max:255'],
            'banner_slides.*.description' => ['nullable', 'string'],
            'banner_slides.*.button_text' => ['nullable', 'string', 'max:255'],
            'banner_slides.*.button_url' => ['nullable', 'string', 'max:255'],
            'banner_slides.*.image' => ['nullable', 'string', 'max:255'],
            'banner_slides_en' => ['nullable', 'array', 'max:10'],
            'banner_slides_en.*.title' => ['nullable', 'string', 'max:255'],
            'banner_slides_en.*.sub_title' => ['nullable', 'string', 'max:255'],
            'banner_slides_en.*.description' => ['nullable', 'string'],
            'banner_slides_en.*.button_text' => ['nullable', 'string', 'max:255'],
            'banner_slides_en.*.button_url' => ['nullable', 'string', 'max:255'],
            'banner_slides_en.*.image' => ['nullable', 'string', 'max:255'],
            'banner_slide_image_files' => ['nullable', 'array', 'max:10'],
            'banner_slide_image_files.*' => ['nullable', 'image', 'max:40960'],
        ]);

        $settings = $widget->settings ?? [];
        $settingsEn = $widget->settings_en ?? [];

        if ($request->hasAny(['button_text', 'button_url'])) {
            $settings['button_text'] = trim((string) ($validated['button_text'] ?? '')) ?: null;
            $settings['button_url'] = trim((string) ($validated['button_url'] ?? '')) ?: null;
        }

        if ($request->hasAny(['button_text_en', 'button_url_en'])) {
            $settingsEn['button_text'] = trim((string) ($validated['button_text_en'] ?? '')) ?: null;
            $settingsEn['button_url'] = trim((string) ($validated['button_url_en'] ?? '')) ?: null;
        }

        foreach (($validated['setting_fields'] ?? []) as $settingKey => $settingValue) {
            $settings[$settingKey] = trim((string) $settingValue) ?: null;
        }

        foreach (($validated['setting_fields_en'] ?? []) as $settingKey => $settingValue) {
            $settingsEn[$settingKey] = trim((string) $settingValue) ?: null;
        }

        if (Str::startsWith($widget->key, 'product_option_') || Str::startsWith($widget->key, 'restaurant_product_')) {
            $category = isset($validated['category_id'])
                ? Category::query()->whereKey($validated['category_id'])->first()
                : null;

            $settings['category_id'] = $category?->id;
            $settings['category_slug'] = $category?->slug;
        }

        if ($widget->key === 'feedback_home') {
            $settings['items'] = $this->feedbackItems($validated['feedback_items'] ?? []);
            $settingsEn['items'] = $this->feedbackItems($validated['feedback_items_en'] ?? []);
        }

        if ($widget->key === 'banner_home') {
            $settings['slides'] = $this->bannerSlides(
                $validated['banner_slides'] ?? [],
                $request->file('banner_slide_image_files', [])
            );

            // English slides share the same images uploaded in slide files, but use text fields from banner_slides_en
            $slidesEn = $validated['banner_slides_en'] ?? [];
            foreach ($slidesEn as $i => $slide) {
                // If a new image was uploaded for this slide index, use it. Otherwise, fallback to the VI slide image or input image
                if (isset($request->file('banner_slide_image_files')[$i])) {
                    // image is already stored and populated in the VI slide, so we can copy it from VI slide image
                }
                // We'll map English slides using bannerSlides helper but passing empty files (they'll use the image from banner_slides_en input)
                // bannerSlides takes care of putting the image field from the slides array
            }
            $settingsEn['slides'] = $this->bannerSlides(
                $slidesEn,
                []
            );
            // Copy slide images from VI slides if they are empty in EN slides
            if (isset($settings['slides']) && isset($settingsEn['slides'])) {
                foreach ($settingsEn['slides'] as $index => &$enSlide) {
                    if (empty($enSlide['image']) && isset($settings['slides'][$index]['image'])) {
                        $enSlide['image'] = $settings['slides'][$index]['image'];
                    }
                }
            }
        }

        if ($this->hasImageConfig($widget->key)) {
            $settings['images'] = $this->widgetImages(
                $validated['widget_images'] ?? [],
                $request->file('widget_image_files', []),
                $this->imageConfigCount($widget->key)
            );
        }

        $widget->update([
            'title' => $validated['title'] ?? null,
            'title_en' => $validated['title_en'] ?? null,
            'sub_title' => $validated['sub_title'] ?? null,
            'sub_title_en' => $validated['sub_title_en'] ?? null,
            'description' => $validated['description'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active'),
            'settings' => $settings,
            'settings_en' => $settingsEn,
        ]);

        return redirect()->route('admin.widgets.index', ['page' => $page])->with('status', 'Đã cập nhật widget frontend.');
    }

    private function widgetImages(array $images, array $files = [], int $limit = 4): array
    {
        return collect(range(0, $limit - 1))
            ->map(function (int $index) use ($images, $files): string {
                if (isset($files[$index])) {
                    return $files[$index]->store('widgets', 'public');
                }

                return trim((string) ($images[$index] ?? ''));
            })
            ->filter()
            ->values()
            ->all();
    }

    private function bannerSlides(array $slides, array $files = []): array
    {
        return collect($slides)
            ->take(10)
            ->map(function (array $slide, int|string $index) use ($files): array {
                $image = trim((string) ($slide['image'] ?? ''));

                if (isset($files[$index])) {
                    $image = $files[$index]->store('widgets', 'public');
                }

                return [
                    'title' => trim((string) ($slide['title'] ?? '')),
                    'sub_title' => trim((string) ($slide['sub_title'] ?? '')),
                    'description' => trim((string) ($slide['description'] ?? '')),
                    'button_text' => trim((string) ($slide['button_text'] ?? '')),
                    'button_url' => trim((string) ($slide['button_url'] ?? '')),
                    'image' => $image,
                ];
            })
            ->filter(fn (array $slide): bool => collect($slide)->filter()->isNotEmpty())
            ->values()
            ->all();
    }

    private function validateWidgetUploadErrors(Request $request): void
    {
        $this->validateBannerUploadErrors($request);

        $files = $request->file('widget_image_files', []);

        if (! is_array($files)) {
            return;
        }

        foreach ($files as $index => $file) {
            if (! $file || $file->isValid()) {
                continue;
            }

            $label = 'Ảnh ' . ((int) $index + 1);

            validator([], [])->after(function ($validator) use ($label, $file): void {
                $validator->errors()->add('widget_image_files.' . $label, $label . ': ' . $this->uploadErrorMessage($file->getError()));
            })->validate();
        }
    }

    private function uploadErrorMessage(int $errorCode): string
    {
        $runtimeInfo = sprintf(
            ' PHP runtime: upload_max_filesize=%s, post_max_size=%s, php.ini=%s.',
            ini_get('upload_max_filesize') ?: 'unknown',
            ini_get('post_max_size') ?: 'unknown',
            php_ini_loaded_file() ?: 'unknown'
        );

        return match ($errorCode) {
            UPLOAD_ERR_INI_SIZE => 'File vượt giới hạn upload_max_filesize trong php.ini.' . $runtimeInfo,
            UPLOAD_ERR_FORM_SIZE => 'File vượt giới hạn MAX_FILE_SIZE của form.' . $runtimeInfo,
            UPLOAD_ERR_PARTIAL => 'File chỉ upload được một phần, vui lòng thử lại.' . $runtimeInfo,
            UPLOAD_ERR_NO_FILE => 'Chưa chọn file upload.' . $runtimeInfo,
            UPLOAD_ERR_NO_TMP_DIR => 'Server thiếu thư mục tạm để upload file.' . $runtimeInfo,
            UPLOAD_ERR_CANT_WRITE => 'Server không ghi được file upload vào ổ đĩa.' . $runtimeInfo,
            UPLOAD_ERR_EXTENSION => 'Một PHP extension đã chặn upload file.' . $runtimeInfo,
            default => 'Upload thất bại với mã lỗi PHP ' . $errorCode . '.' . $runtimeInfo,
        };
    }

    private function validateBannerUploadErrors(Request $request): void
    {
        $files = $request->file('banner_slide_image_files', []);

        if (! is_array($files)) {
            return;
        }

        foreach ($files as $index => $file) {
            if (! $file || $file->isValid()) {
                continue;
            }

            $label = 'Slide ' . ((int) $index + 1);

            validator([], [])->after(function ($validator) use ($label, $file): void {
                $validator->errors()->add('banner_slide_image_files.' . $label, $label . ': ' . $this->uploadErrorMessage($file->getError()));
            })->validate();
        }
    }

    private function hasImageConfig(string $key): bool
    {
        return array_key_exists($key, self::IMAGE_CONFIG_WIDGETS);
    }

    private function imageConfigCount(string $key): int
    {
        return self::IMAGE_CONFIG_WIDGETS[$key] ?? 0;
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
            'page' => ['nullable', 'string'],
            'widgets' => ['required', 'array'],
            'widgets.*' => ['integer', 'exists:frontend_widgets,id'],
        ]);

        $page = (string) ($validated['page'] ?? 'home');
        $pageKeys = $this->pageKeys($page);
        $allowedIds = FrontendWidget::query()
            ->whereIn('key', $pageKeys)
            ->pluck('id')
            ->all();

        $widgetIds = collect($validated['widgets'])
            ->filter(fn ($id) => in_array($id, $allowedIds, true))
            ->values()
            ->all();

        foreach ($widgetIds as $index => $widgetId) {
            FrontendWidget::query()
                ->whereKey($widgetId)
                ->update(['sort_order' => $index]);
        }

        return response()->json(['message' => 'Đã cập nhật thứ tự widget.']);
    }

    public static function extraScalarSettingFields(array $settings): Collection
    {
        return collect($settings)
            ->reject(fn ($value, $key) => in_array($key, [
                'button_text',
                'button_url',
                'images',
                'items',
                'category_id',
                'category_slug',
            ], true))
            ->filter(fn ($value) => is_scalar($value) || $value === null)
            ->mapWithKeys(fn ($value, $key) => [$key => $value]);
    }

    private function pageKeys(string $page): array
    {
        return self::PAGE_WIDGET_GROUPS[$page] ?? self::PAGE_WIDGET_GROUPS['home'];
    }

    private function pageByWidgetKey(string $key): string
    {
        foreach (self::PAGE_WIDGET_GROUPS as $page => $keys) {
            if (in_array($key, $keys, true)) {
                return $page;
            }
        }

        return 'home';
    }

    private function ensurePageWidgets(string $page): void
    {
        if ($page !== 'restaurant') {
            return;
        }

        foreach (self::DEFAULT_RESTAURANT_WIDGETS as $key => $widget) {
            FrontendWidget::query()->firstOrCreate(
                ['key' => $key],
                $widget + ['is_active' => true]
            );
        }
    }
}
