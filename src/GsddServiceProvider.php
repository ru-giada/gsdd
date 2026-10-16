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
        $this->publishes([
            __DIR__.'../templates/TEMPLATE_BUGFIX.md' => config_path('specs/bugfix.md')
            #rivedere "config_path"
        ], 'gsdd-bugfix');

        $this->publishes([
            __DIR__.'../templates/TEMPLATE_FEATURE.md' => config_path('specs/feature.md')
        ], 'gsdd-feature');

        $this->publishes([
            __DIR__.'../templates/TEMPLATE_REFACTORING.md' => config_path('specs/refactoring.md')
        ], 'gsdd-refactoring');
    }
}
