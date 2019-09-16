<?php

namespace SimpleSquid\LaravelVend;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SimpleSquid\LaravelVend\Controllers\VendOauthController;
use SimpleSquid\LaravelVend\Controllers\VendOauthRedirectController;
use SimpleSquid\LaravelVend\Exceptions\RouteException;
use SimpleSquid\LaravelVend\Exceptions\TokenManagerException;
use SimpleSquid\Vend\Vend;

class VendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/vend.php' => config_path('vend.php')]);
        }

        Route::macro('vend', function ($url = 'vend') {
            Route::name('vend.oauth.')->group(function () use ($url) {
                Route::get($url, VendOauthController::class)->name('request');
                Route::get("$url/redirect", VendOauthRedirectController::class)->name('redirect');
            });
        });

        foreach (config('vend.observers', []) as $model => $observer) {
            $model::observe($observer);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     * @throws \Throwable
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/vend.php', 'vend');

        throw_if(!is_subclass_of(config('vend.oauth.token_manager'), VendTokenManager::class), TokenManagerException::class);

        $this->app->bind(VendTokenManager::class, config('vend.oauth.token_manager'));

        $this->app->singleton(Vend::class, function () {
            $driver = config('vend.driver', 'api');

            if (is_null($driver) || $driver === 'log') {
                return new NullDriver($driver === 'log');
            }

            $vend = Vend::getInstance();

            $vend->userAgent(config('vend.user_agent', 'Laravel Vend SDK'))
                 ->requestTimeout(config('vend.request_timeout', 2))
                 ->confirmationTimeout(config('vend.confirmation_timeout', 30));

            $auth = config('vend.authorisation', 'personal');

            if ($auth === 'personal') {
                $vend->domainPrefix(config('vend.personal.domain_prefix'))
                     ->personalAccessToken(config('vend.personal.access_token'));
            } elseif ($auth === 'oauth') {
                throw_if(!route('vend.oauth.redirect'), RouteException::class);

                $vend->clientId(config('vend.oauth.client_id'))
                     ->clientSecret(config('vend.oauth.client_secret'))
                     ->redirectUri(route('vend.oauth.redirect'));

                $tokenManager = $this->app->make(VendTokenManager::class);

                if ($tokenManager->hasToken()) {
                    $vend->domainPrefix($tokenManager->getDomainPrefix())
                         ->authorisationToken($tokenManager->getToken());
                }
            }

            return $vend;
        });

        $this->app->alias(Vend::class, 'vend');
    }
}
