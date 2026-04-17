<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function __invoke(Request $request): View
    {
        $keyword = trim((string) $request->string('keyword'));
        $roleId = $request->integer('role_id');

        $users = User::query()
            ->with('roles.permissions')
            ->when($keyword !== '', function ($query) use ($keyword) {
                $query->where(function ($nestedQuery) use ($keyword) {
                    $nestedQuery
                        ->where('full_name', 'like', "%{$keyword}%")
                        ->orWhere('username', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%");
                });
            })
            ->when($roleId > 0, fn ($query) => $query->whereHas('roles', fn ($roleQuery) => $roleQuery->where('roles.id', $roleId)))
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString()
            ->onEachSide(1);

        return view('backend.management.users', [
            'users' => $users,
            'roles' => Role::query()->orderBy('title')->get(),
            'filters' => [
                'keyword' => $keyword,
                'role_id' => $roleId > 0 ? $roleId : null,
            ],
        ]);
    }
}
