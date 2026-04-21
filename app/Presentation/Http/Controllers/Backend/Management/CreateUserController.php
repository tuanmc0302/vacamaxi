<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CreateUserController extends Controller
{
    public function __invoke(): View
    {
        return view('backend.management.users-create');
    }
}
