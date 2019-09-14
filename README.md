# Vend SDK (a Laravel Package)
[![Latest Version](https://img.shields.io/github/release/simplesquid/laravel-vend-sdk.svg?style=flat-square)](https://github.com/simplesquid/laravel-vend-sdk/releases)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/simplesquid/laravel-vend-sdk.svg?style=flat-square)](https://packagist.org/packages/simplesquid/laravel-vend-sdk)

A Laravel provider package for our PHP SDK for Vend POS | https://docs.vendhq.com/

Contributions, issues and suggestions are very much welcome.

## Installation

To install the SDK in your project you need to require the package via composer:

```bash
composer require simplesquid/laravel-vend-sdk
```

The package will automatically register itself.

To publish the config file to `config/vend.php` run:

```bash
php artisan vendor:publish --provider="SimpleSquid\LaravelVend\VendServiceProvider"
```