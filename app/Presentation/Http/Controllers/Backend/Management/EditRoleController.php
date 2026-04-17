<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\View\View;

class EditRoleController extends Controller
{
    public function __invoke(Role $role): View
    {
        return view('backend.management.roles-edit', [
            'role' => $role->load('permissions'),
            'permissions' => Permission::query()
                ->orderBy('title')
                ->get(),
        ]);
    }
}
