<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\View\View;

class CreateRoleController extends Controller
{
    public function __invoke(): View
    {
        return view('backend.management.roles-create', [
            'permissions' => Permission::query()
                ->orderBy('title')
                ->get(),
        ]);
    }
}
