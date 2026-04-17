<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\View\View;

class CreateUserController extends Controller
{
    public function __invoke(): View
    {
        return view('backend.management.users-create', [
            'roles' => Role::query()
                ->orderBy('title')
                ->get(),
        ]);
    }
}
