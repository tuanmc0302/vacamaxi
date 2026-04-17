<?php

namespace App\Presentation\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowLoginController extends Controller
{
    public function __invoke(): View
    {
        return view('backend.auth.login');
    }
}
