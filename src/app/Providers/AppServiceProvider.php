<?php

namespace App\Providers;

use Tests\HasInDatabase;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\Constrains\HasInDatabase as PackageHasInDatabase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PackageHasDatabase::class,HasInDatabase::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
