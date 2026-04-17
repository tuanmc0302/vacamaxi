<?php

namespace App\UseCases\System;

use App\Domain\System\Contracts\SystemStatusRepositoryInterface;

class GetSystemStatus
{
    public function __construct(
        private readonly SystemStatusRepositoryInterface $systemStatusRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function handle(): array
    {
        return $this->systemStatusRepository->getStatus();
    }
}
