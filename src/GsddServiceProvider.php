<?php

//namespace App\Providers;
namespace Gia\Gsdd;

use Illuminate\Support\ServiceProvider;

class GsddServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //utilizzato per binding al Service Container
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //cosa viene fatto col publish
        dd("Funziono!! :D");
    }
}
