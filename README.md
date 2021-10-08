# Vend SDK (a Laravel Package)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/simplesquid/laravel-vend-sdk.svg?style=flat-square)](https://packagist.org/packages/simplesquid/laravel-vend-sdk)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/simplesquid/laravel-vend-sdk.svg?style=flat-square)](https://packagist.org/packages/simplesquid/laravel-vend-sdk)

A Laravel package for our [PHP SDK for Vend POS](https://github.com/simplesquid/vend-sdk).

## Installation

You can install this package via composer:

```bash
composer require simplesquid/laravel-vend-sdk
```

The package will automatically register itself with the Laravel service container.

To publish the config file to `config/vend.php` run:

```bash
php artisan vendor:publish --provider="SimpleSquid\LaravelVend\VendServiceProvider"
```

## OAuth Setup

Should you wish to make use of the OAuth authorisation method, you will need to register your application on the [Vend Developer page](https://developers.vendhq.com/) and set the redirect URI to the named route url, `vend.oauth.request`.

Then, copy the client ID and secret to your environment variables. You will also need to create an implementation of `\SimpleSquid\LaravelVend\VendTokenManager` to store and retrieve the access token (it is recommended to be saved in your database).

Finally, direct your user to the named route, `vend.oauth.request`, in order to request access. The access token will be saved upon the user's successful return to your application, and they will be redirected to the previous page.

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

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email security@simplesquid.co.za instead of using the issue tracker.

## Credits

- [Matthew Poulter](https://github.com/mdpoulter)
- [All Contributors](../../contributors)

Package skeleton based on [spatie/skeleton-php](https://github.com/spatie/skeleton-php).

## About us

SimpleSquid is a small web development and design company based in Cape Town, South Africa.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
