<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->configureUrlScheme();
        $this->registerAuthorization();
        $this->configureEloquent();
    }

    protected function registerAuthorization(): void
    {
        Gate::define('viewHealth', fn($user = null) => $this->app->isLocal());

        Gate::before(function (User $user) {
            return $user->hasRole(RoleEnum::SuperAdmin) ? true : null;
        });
    }

    protected function configureUrlScheme(): void
    {
        if (!$this->app->isLocal()) {
            URL::forceScheme('https');
        }
    }

    protected function configureEloquent(): void
    {
        DB::prohibitDestructiveCommands($this->app->isProduction());

        Model::unguard();
        Model::shouldBeStrict(!$this->app->isProduction());
        Model::preventLazyLoading(!$this->app->isProduction());
    }
}
