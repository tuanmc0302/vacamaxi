<?php

namespace App\Presentation\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Backend\Auth\LoginRequest;
use App\UseCases\Auth\LoginBackendUser;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, LoginBackendUser $loginBackendUser): RedirectResponse
    {
        $user = $loginBackendUser->handle($request->toDto());

        if (! $user) {
            return back()
                ->withInput($request->safe()->only(['username', 'remember']))
                ->withErrors([
                    'username' => 'Thông tin đăng nhập không đúng.',
                ]);
        }

        $request->session()->regenerate();
        $request->session()->forget('admin_two_factor_passed');

        if ($user->isTwoFactorEnabled()) {
            return redirect()->route('admin.two-factor.challenge');
        }

        $request->session()->put('admin_two_factor_passed', true);

        return redirect()->route('admin.dashboard');
    }
}
