<?php

namespace App\Presentation\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\UseCases\Auth\LogoutBackendUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $request, LogoutBackendUser $logoutBackendUser): RedirectResponse
    {
        $logoutBackendUser->handle();

        $request->session()->forget('admin_two_factor_passed');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
