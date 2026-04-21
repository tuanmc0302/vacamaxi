<?php

namespace App\Providers;

use App\Domain\Auth\Contracts\BackendAuthenticatorInterface;
use App\Domain\System\Contracts\SystemStatusRepositoryInterface;
use App\Infrastructure\Auth\LaravelBackendAuthenticator;
use App\Infrastructure\Persistence\System\LaravelSystemStatusRepository;
use App\Services\SiteSettingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BackendAuthenticatorInterface::class, LaravelBackendAuthenticator::class);
        $this->app->bind(SystemStatusRepositoryInterface::class, LaravelSystemStatusRepository::class);
        $this->app->singleton(SiteSettingService::class, SiteSettingService::class);
    }

    public function boot(): void
    {
        View::composer('*', function ($view): void {
            try {
                $view->with('siteSettings', app(SiteSettingService::class)->viewData());
            } catch (\Throwable) {
                $view->with('siteSettings', [
                    'site_name' => 'VACAMAXI',
                    'site_title' => 'VACAMAXI',
                    'site_description' => 'VACAMAXI',
                    'logo_url' => asset('image/logo.png'),
                    'favicon_url' => asset('favicon.ico'),
                    'seo_title' => 'VACAMAXI',
                    'seo_description' => 'VACAMAXI',
                    'seo_keywords' => '',
                    'seo_image_url' => null,
                    'address' => '',
                    'phone_wine' => '',
                    'phone_beef' => '',
                    'email' => '',
                    'website_url' => '',
                    'zalo_url' => '',
                    'facebook_url' => '',
                    'youtube_url' => '',
                    'google_map_url' => '',
                    'google_map_embed_url' => '',
                ]);
            }
        });
    }
}
