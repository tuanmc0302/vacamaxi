<?php

namespace App\Domain\Auth\Contracts;

use App\Models\User;
use App\UseCases\Auth\DataTransferObjects\BackendLoginData;

interface BackendAuthenticatorInterface
{
    public function attempt(BackendLoginData $data): ?User;

    public function logout(): void;
}
