<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleManagementController extends Controller
{
    public function __invoke(Request $request): View
    {
        $keyword = trim((string) $request->string('keyword'));

        return view('backend.management.roles', [
            'roles' => Role::query()
                ->with('permissions')
                ->when($keyword !== '', function ($query) use ($keyword) {
                    $query->where(function ($nestedQuery) use ($keyword) {
                        $nestedQuery
                            ->where('title', 'like', "%{$keyword}%")
                            ->orWhere('name', 'like', "%{$keyword}%");
                    });
                })
                ->orderByDesc('id')
                ->get(),
            'filters' => [
                'keyword' => $keyword,
            ],
        ]);
    }
}
