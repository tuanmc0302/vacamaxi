<?php

namespace App\Presentation\Http\Controllers\Backend\Security;

use App\Http\Controllers\Controller;
use App\Services\Security\GoogleTwoFactorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyTwoFactorChallengeController extends Controller
{
    public function __invoke(Request $request, GoogleTwoFactorService $googleTwoFactorService): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $user = $request->user();

        if (! $user || ! $user->google_two_factor_secret) {
            return redirect()->route('admin.login');
        }

        if (! $googleTwoFactorService->verifyCode($user->google_two_factor_secret, $request->string('code')->toString())) {
            return back()->withErrors([
                'code' => 'Mã xác thực không đúng hoặc đã hết hạn.',
            ]);
        }

        $request->session()->put('admin_two_factor_passed', true);

        return redirect()->route('admin.dashboard');
    }
}
