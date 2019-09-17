# Vend SDK (a Laravel Package)
[![Latest Version](https://img.shields.io/github/release/simplesquid/laravel-vend-sdk.svg?style=flat-square)](https://github.com/simplesquid/laravel-vend-sdk/releases)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/simplesquid/laravel-vend-sdk.svg?style=flat-square)](https://packagist.org/packages/simplesquid/laravel-vend-sdk)

A Laravel provider package for [our PHP SDK for Vend POS](https://github.com/simplesquid/vend-sdk) | https://docs.vendhq.com/

Contributions, issues and suggestions are very much welcome.

## Installation

To install the SDK in your project you need to require the package via composer:

```bash
composer require simplesquid/laravel-vend-sdk
```

The package will automatically register itself with the Laravel service container.

To publish the config file to `config/vend.php` run:

```bash
php artisan vendor:publish --provider="SimpleSquid\LaravelVend\VendServiceProvider"
```

## OAuth Authorisation

Should you wish to make use of the OAuth authorisation method, you will need to register your application on the [Vend Developer page](https://developers.vendhq.com/) and set the redirect URI to the value of `route('vend.oauth.request')`.

You will then need to copy the client ID and secret to your environment variables. You will also need to create an implementation of `\SimpleSquid\LaravelVend\VendTokenManager` to store and retrieve the access token (it is recommended to be saved in your database).

Finally, direct your user to `route('vend.oauth.request')` in order to request access. The access token will be saved upon the user's successful return to your application, and they will be redirected to the previous page.

## Usage

An example use case is shown below. The `VendRequestJob` handles both rate limiting and refreshes of the OAuth token.

```php
use SimpleSquid\LaravelVend\Facades\Vend;
use SimpleSquid\LaravelVend\Jobs\VendRequestJob;

/* Get the list of products. */
public function getProducts() {
    return VendRequestJob::dispatchNow(function () {
        return Vend::product()->get();
    });
}

/* Create a new product. */
public function createProduct($product) {
    VendRequestJob::dispatch(function () use $product {
        return Vend::product()->create($product);
    });
}
```

For more examples, feel free to dive into the code.
