<?php

namespace App\Providers;

use App\Domain\Auth\Contracts\BackendAuthenticatorInterface;
use App\Domain\System\Contracts\SystemStatusRepositoryInterface;
use App\Infrastructure\Auth\LaravelBackendAuthenticator;
use App\Infrastructure\Persistence\System\LaravelSystemStatusRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BackendAuthenticatorInterface::class, LaravelBackendAuthenticator::class);
        $this->app->bind(SystemStatusRepositoryInterface::class, LaravelSystemStatusRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
