# Package to add an easy way to add a basic search functionality to your models

Provides an Eloquent trait to add to your models to integrate an easy way to search in your model and relations.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sqits/laravel-searchable.svg?style=flat-square)](https://packagist.org/packages/sqits/laravel-searchable)
[![Build Status](https://img.shields.io/travis/sqits/laravel-searchable/master.svg?style=flat-square)](https://travis-ci.org/sqits/laravel-searchable)
[![Quality Score](https://img.shields.io/scrutinizer/g/sqits/laravel-searchable.svg?style=flat-square)](https://scrutinizer-ci.com/g/sqits/laravel-searchable)
[![StyleCI](https://github.styleci.io/repos/180816659/shield)](https://styleci.io/repos/180816659)
[![Total Downloads](https://img.shields.io/packagist/dt/sqits/laravel-searchable.svg?style=flat-square)](https://packagist.org/packages/sqits/laravel-searchable)

## Installation and usage

This package requires PHP 7.2 and Laravel 5.6 or higher. Install the package by running the following command in your console;

``` bash
composer require sqits/laravel-searchable
```

You can publish the config file with:

``` bash
php artisan vendor:publish --provider="Sqits\Searchable\SearchableServiceProvider" --tag="config"
```

This is the contents of the published config file:

``` php
return [

    /*
     * Define the parameter in your request which contains the search values
     */

    'parameter' => 'search',

];
```

Add the Trait to your model

``` php
use Sqits\Searchable\Traits\HasSearchable;

class Example extends Model {

    use HasSearchable;
}
```

Add the configuration to your model which fields are searchable

``` php

// In the examples we are using `like`, but every value which you could use in eloquent are usable eg '=', '=>', '<=', '>', '<' etc.

// simple field
protected $searchables = [
    'name' => 'like',
];

// combined fields
protected $searchables = [
    'name' => [
        'first_name' => 'like',
        'last_name' => 'like',
    ],
];
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security-related issues, please [email](mailto:info@sqits.nl) to info@sqits.nl instead of using the issue tracker.

## Credits
upda
- [Sqits](https://github.com/sqits)
- [Ruud Schaaphuizen](https://github.com/rschaaphuizen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
