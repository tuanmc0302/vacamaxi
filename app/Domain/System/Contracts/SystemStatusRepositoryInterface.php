<?php

namespace App\Domain\System\Contracts;

interface SystemStatusRepositoryInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getStatus(): array;
}
