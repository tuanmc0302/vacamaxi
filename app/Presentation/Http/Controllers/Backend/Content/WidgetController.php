<?php

namespace App\Presentation\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\FrontendWidget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WidgetController extends Controller
{
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
        ]);

        $widget->update([
            'title' => $validated['title'] ?? null,
            'sub_title' => $validated['sub_title'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.widgets.index')->with('status', 'Đã cập nhật widget trang chủ.');
    }
}