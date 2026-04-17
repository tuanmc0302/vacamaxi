<?php

namespace App\Presentation\Http\Controllers\Backend\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShowTwoFactorChallengeController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        if (! auth()->user()?->isTwoFactorEnabled()) {
            return redirect()->route('admin.dashboard');
        }

        return view('backend.security.two-factor-challenge');
    }
}
