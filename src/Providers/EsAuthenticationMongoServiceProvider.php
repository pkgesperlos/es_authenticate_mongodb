<?php

namespace Esperlos98\EsauthenticationMongo\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Esperlos98\EsauthenticationMongo\Http\Middleware\EsAuthenticationCheckEncrypt;

class EsAuthenticationMongoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/../../config/esauthenticationMongo.php' => config_path('esauthenticationMongo.php'),
        ], 'config');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('EsAuthenticationCheckEncrypt', EsAuthenticationCheckEncrypt::class);
        $router->pushMiddlewareToGroup('api', EsAuthenticationCheckEncrypt::class);
    }
}

