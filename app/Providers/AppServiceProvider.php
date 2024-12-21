<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureUrl();
        $this->configureModels();
        $this->configureVite();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            (bool)
            $this->app->environment('production'),
        );
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard();
    }

    private function configureUrl(): void
    {
        URL::forceScheme('https');
    }

    private function configureVite(): void
    {
        Vite::usePrefetchStrategy('aggressive');
    }
}
