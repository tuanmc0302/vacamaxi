<?php

namespace App\Infrastructure\Auth;

use App\Domain\Auth\Contracts\BackendAuthenticatorInterface;
use App\Models\User;
use App\UseCases\Auth\DataTransferObjects\BackendLoginData;
use Illuminate\Support\Facades\Auth;

class LaravelBackendAuthenticator implements BackendAuthenticatorInterface
{
    public function attempt(BackendLoginData $data): ?User
    {
        $credentials = [
            'username' => $data->username,
            'password' => $data->password,
        ];

        if (! Auth::attempt($credentials, $data->remember)) {
            return null;
        }

        /** @var User|null $user */
        $user = Auth::user();

        return $user;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
