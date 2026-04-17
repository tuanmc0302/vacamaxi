<?php

namespace App\Presentation\Http\Controllers\Backend\Security;

use App\Http\Controllers\Controller;
use App\Services\Security\GoogleTwoFactorService;
use Illuminate\View\View;

class ShowTwoFactorSettingsController extends Controller
{
    public function __invoke(GoogleTwoFactorService $googleTwoFactorService): View
    {
        $user = auth()->user();
        $secret = $user?->google_two_factor_secret ?: $googleTwoFactorService->generateSecret();

        if ($user && ! $user->google_two_factor_secret) {
            $user->forceFill([
                'google_two_factor_secret' => $secret,
            ])->save();
        }

        return view('backend.security.two-factor-settings', [
            'secret' => $secret,
            'otpAuthUrl' => $googleTwoFactorService->getOtpAuthUrl(
                issuer: config('app.name', 'Admin'),
                accountName: $user?->username ?? 'admin',
                secret: $secret,
            ),
            'qrCodeUrl' => 'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data='.rawurlencode(
                $googleTwoFactorService->getOtpAuthUrl(
                    issuer: config('app.name', 'Admin'),
                    accountName: $user?->username ?? 'admin',
                    secret: $secret,
                )
            ),
        ]);
    }
}
