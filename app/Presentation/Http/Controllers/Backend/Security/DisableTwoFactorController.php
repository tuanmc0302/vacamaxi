<?php

namespace App\Presentation\Http\Controllers\Backend\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DisableTwoFactorController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user) {
            $user->forceFill([
                'google_two_factor_enabled' => false,
                'google_two_factor_secret' => null,
                'google_two_factor_confirmed_at' => null,
            ])->save();
        }

        $request->session()->forget('admin_two_factor_passed');

        return back()->with('status', 'Đã tắt Google 2FA.');
    }
}
