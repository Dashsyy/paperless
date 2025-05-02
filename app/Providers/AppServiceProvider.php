<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->configureUrlScheme();
        $this->configureEloquent();
    }

    protected function configureUrlScheme(): void
    {
        if (! $this->app->isLocal()) {
            URL::forceScheme('https');
        }
    }

    protected function configureEloquent(): void
    {
        DB::prohibitDestructiveCommands($this->app->isProduction());

        Model::unguard();
        Model::shouldBeStrict(! $this->app->isProduction());
        Model::preventLazyLoading(! $this->app->isProduction());
    }
}
