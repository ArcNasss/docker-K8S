<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Interfaces\ThemeInterface;
use App\Contracts\Repositories\ThemeRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Contracts\Interfaces\AuthInterface::class, \App\Contracts\Repositories\Auth\AuthRepository::class);
        $this->app->bind(ThemeInterface::class, ThemeRepository::class);
        $this->app->bind(\App\Contracts\Interfaces\SectionInterface::class, \App\Contracts\Repositories\SectionRepository::class);
        $this->app->bind(\App\Contracts\Interfaces\VariantInterface::class, \App\Contracts\Repositories\VariantRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
