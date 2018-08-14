<?php
namespace Nemozar\LaravelPermissionGui;
/**
 * Сервис провайдер для подключения модулей
 */
class GuiServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-permission-gui.php',
            'laravel-permission-gui'
        );
        $this->setupRoutes($this->app->router);
        $this->loadTranslationsFrom(realpath(__DIR__.'/../translations'), 'laravel-permission-gui');
        $this->publishes([
            __DIR__.'/../config/' => base_path('config'),
        ]);

        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'laravel-permission-gui');
        $this->publishes(
            [__DIR__.'/../views' => base_path('resources/views/vendor/laravel-permission-gui')],
            'views'
        );
        $this->publishes(
            [__DIR__.'/../translations' => base_path('resources/lang/vendor/laravel-permission-gui')],
            'translations'
        );
    }

    public function setupRoutes(Router $router)
    {
        $router->group(
            ['namespace' => 'Nemozar\LaravelPermissionGui\Http\Controllers'],
            function ($router) {
                include __DIR__.'/Http/routes.php';
            }
        );
    }

    public function register()
    {
    }
}
