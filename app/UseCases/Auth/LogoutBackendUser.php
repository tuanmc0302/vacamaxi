<?php

namespace App\UseCases\Auth;

use App\Domain\Auth\Contracts\BackendAuthenticatorInterface;

class LogoutBackendUser
{
    public function __construct(
        private readonly BackendAuthenticatorInterface $backendAuthenticator
    ) {
    }

    public function handle(): void
    {
        $this->backendAuthenticator->logout();
    }
}
