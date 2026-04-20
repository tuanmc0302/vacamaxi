<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ExpertController extends Controller
{
    public function index(): View
    {
        $experts = Expert::orderBy('sort_order')->latest()->paginate(20);

        return view('backend.management.experts.index', compact('experts'));
    }

    public function create(): View
    {
        return view('backend.management.experts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('experts', 'public');
        }

        Expert::create($validated);

        return redirect()->route('admin.experts.index')->with('status', 'Đã thêm chuyên gia thành công.');
    }

    public function edit(Expert $expert): View
    {
        return view('backend.management.experts.edit', compact('expert'));
    }

    public function update(Request $request, Expert $expert): RedirectResponse
    {
        $validated = $this->validatedData($request);

        if ($request->hasFile('image')) {
            if ($expert->image && ! str_starts_with($expert->image, 'http')) {
                Storage::disk('public')->delete($expert->image);
            }

            $validated['image'] = $request->file('image')->store('experts', 'public');
        }

        $expert->update($validated);

        return redirect()->route('admin.experts.index')->with('status', 'Đã cập nhật chuyên gia thành công.');
    }

    public function destroy(Expert $expert): RedirectResponse
    {
        if ($expert->image && ! str_starts_with($expert->image, 'http')) {
            Storage::disk('public')->delete($expert->image);
        }

        $expert->delete();

        return redirect()->route('admin.experts.index')->with('status', 'Đã xóa chuyên gia.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
