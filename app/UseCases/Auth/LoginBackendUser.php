<?php

namespace App\UseCases\Auth;

use App\Domain\Auth\Contracts\BackendAuthenticatorInterface;
use App\Models\User;
use App\UseCases\Auth\DataTransferObjects\BackendLoginData;

class LoginBackendUser
{
    public function __construct(
        private readonly BackendAuthenticatorInterface $backendAuthenticator
    ) {
    }

    public function handle(BackendLoginData $data): ?User
    {
        return $this->backendAuthenticator->attempt($data);
    }
}
