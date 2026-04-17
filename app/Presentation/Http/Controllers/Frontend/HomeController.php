<?php

namespace App\Presentation\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontendWidget;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $frontendData = json_decode(file_get_contents(resource_path('data/frontend.json')), true) ?: [];

        try {
            $widgets = FrontendWidget::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->keyBy('key');
        } catch (Throwable) {
            $widgets = new Collection();
        }

        return view('frontend.home', [
            'frontendData' => $frontendData,
            'widgets' => $widgets,
        ]);
    }
}