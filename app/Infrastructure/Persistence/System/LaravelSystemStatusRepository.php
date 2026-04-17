<?php

namespace App\Infrastructure\Persistence\System;

use App\Domain\System\Contracts\SystemStatusRepositoryInterface;
use Illuminate\Support\Facades\DB;

class LaravelSystemStatusRepository implements SystemStatusRepositoryInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getStatus(): array
    {
        return [
            'app' => config('app.name'),
            'environment' => app()->environment(),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'database' => DB::connection()->getDatabaseName(),
            'timestamp' => now()->toIso8601String(),
        ];
    }
}
