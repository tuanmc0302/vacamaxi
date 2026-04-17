<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;

class EditUserController extends Controller
{
    public function __invoke(User $user): View
    {
        return view('backend.management.users-edit', [
            'user' => $user->load('roles'),
            'roles' => Role::query()
                ->orderBy('title')
                ->get(),
        ]);
    }
}
