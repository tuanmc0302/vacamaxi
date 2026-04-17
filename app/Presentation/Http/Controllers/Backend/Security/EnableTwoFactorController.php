<?php

namespace App\Presentation\Http\Controllers\Backend\Security;

use App\Http\Controllers\Controller;
use App\Services\Security\GoogleTwoFactorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnableTwoFactorController extends Controller
{
    public function __invoke(Request $request, GoogleTwoFactorService $googleTwoFactorService): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $user = $request->user();
        $secret = $user?->google_two_factor_secret;

        if (! $user || ! $secret) {
            return back()->withErrors([
                'code' => 'Chưa có mã bí mật để kích hoạt Google 2FA.',
            ]);
        }

        if (! $googleTwoFactorService->verifyCode($secret, $request->string('code')->toString())) {
            return back()->withErrors([
                'code' => 'Mã xác thực không hợp lệ.',
            ]);
        }

        $user->forceFill([
            'google_two_factor_enabled' => true,
            'google_two_factor_confirmed_at' => now(),
        ])->save();

        $request->session()->put('admin_two_factor_passed', true);

        return back()->with('status', 'Đã bật Google 2FA thành công.');
    }
}
