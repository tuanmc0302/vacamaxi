<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontendWidget;
use App\Models\Expert;
use App\Models\Contact;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class AboutController extends Controller
{
    public function __construct(
        private readonly MenuService $menuService
    ) {}

    private const ABOUT_WIDGET_KEYS = [
        'about_page_hero',
        'about_page_intro',
        'about_page_values',
        'about_page_experts',
        'about_page_farm',
        'about_page_cta',
    ];

    private const ABOUT_SCALE_WIDGET_KEYS = [
        'about_scale_page_hero',
        'about_scale_page_farm',
        'about_scale_page_experts',
        'about_scale_page_care',
        'about_scale_page_biotech',
        'about_scale_page_ivf',
        'about_scale_page_strategy',
        'about_scale_page_cta',
    ];

    public function show(): View
    {
        return view('frontend.about', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgetsFor(self::ABOUT_WIDGET_KEYS),
            'experts' => Expert::where('is_active', true)->orderBy('sort_order')->take(4)->get(),
        ]);
    }

    public function scale(): View
    {
        return view('frontend.about-scale', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgetsFor(self::ABOUT_SCALE_WIDGET_KEYS),
            'experts' => Expert::where('is_active', true)->orderBy('sort_order')->take(8)->get(),
        ]);
    }

    public function scaleFigma(): View
    {
        return view('frontend.about-scale-figma', [
            'frontendData' => $this->frontendData(),
            'widgets' => $this->widgetsFor(self::ABOUT_SCALE_WIDGET_KEYS),
            'experts' => Expert::where('is_active', true)->orderBy('sort_order')->take(8)->get(),
        ]);
    }

    public function contact(): View
    {
        return view('frontend.contact', [
            'frontendData' => $this->frontendData(),
        ]);
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        Contact::create($validated);

        return response()->json(['message' => 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất!']);
    }

    private function frontendData(): array
    {
        $frontendData = json_decode(file_get_contents(resource_path('data/frontend.json')), true) ?: [];
        $frontendData['nav'] = $this->menuService->getFrontendMenu();

        return $frontendData;
    }

    private function widgetsFor(array $keys): Collection
    {
        try {
            return FrontendWidget::query()
                ->where('is_active', true)
                ->whereIn('key', $keys)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->keyBy('key');
        } catch (Throwable) {
            return new Collection();
        }
    }
}
