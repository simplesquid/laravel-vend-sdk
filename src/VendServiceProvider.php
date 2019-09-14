<?php

namespace SimpleSquid\LaravelVend;

use Illuminate\Support\ServiceProvider;
use SimpleSquid\Vend\Vend;

class VendServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/vend.php', 'vend');

        $this->publishes([__DIR__ . '/../config/vend.php' => config_path('vend.php'),]);
    }

    public function register()
    {
        $this->app->singleton(Vend::class, function () {
            $driver = config('vend.driver', 'api');
            if (is_null($driver) || $driver === 'log') {
                return new NullDriver($driver === 'log');
            }

            $vend = Vend::getInstance();

            $vend->makeClient(config('vend.user_agent', 'Laravel Vend SDK'));

            $auth = config('vend.authorisation', 'personal');
            if ($auth === 'personal') {
                $vend->setPersonalAccessToken(config('vend.personal.domain_prefix'), config('vend.personal.access_token'));
            } elseif ($auth === 'oauth2') {
                $vend->setOAuthIdentifiers(config('vend.oauth2.client_id'), config('vend.oauth2.client_secret'), config('vend.oauth2.redirect_uri'));
            }

            return $vend;
        });

        $this->app->alias(Vend::class, 'vend');
    }
}
