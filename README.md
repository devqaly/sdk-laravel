# Allow your Laravel application to send events while a session is being recorded

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devqaly/devqaly-laravel.svg?style=flat-square)](https://packagist.org/packages/devqaly/devqaly-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/devqaly/devqaly-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/devqaly/devqaly-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/devqaly/devqaly-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/devqaly/devqaly-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/devqaly/devqaly-laravel.svg?style=flat-square)](https://packagist.org/packages/devqaly/devqaly-laravel)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/devqaly-laravel.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/devqaly-laravel)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require devqaly/devqaly-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="devqaly"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Source
    |--------------------------------------------------------------------------
    |
    | This value represents where the events are being created. This value is used
    | to show in devqaly's UI where the event was created.
    | If you have a simple api, and a frontend structure, the default value will be enough.
    | If you have a more complex architecture, it is important to give a descriptive name.
    |
    */
    'source' => env('DEVQALY_SOURCE', 'laravel-sdk'),

    /*
    |--------------------------------------------------------------------------
    | Ignored environments
    |--------------------------------------------------------------------------
    |
    | Which environments we should be checking if a session is being recorded or not.
    | You can add multiple environments by separating them by a comma
    | e.g. staging,local
    |
    */
    'runAtEnvironments' => env('DEVQALY_RUN_AT_ENVIRONMENTS', 'staging'),

    /*
    |--------------------------------------------------------------------------
    | Devqaly's backend
    |--------------------------------------------------------------------------
    |
    | This value will tell the package where to send the events to.
    | If you are using the self-hosted version, this is the place
    | for you to add your backend custom URL
    |
    */
    'api' => env('DEVQALY_API_URL', 'https://api.devqaly.com'),

    /*
    |--------------------------------------------------------------------------
    | Events to log
    |--------------------------------------------------------------------------
    |
    | This value indicates which events we should keep track when a session is being recorded.
    | The possible values are databaseTransaction, logs and exceptions.
    |   databaseTransaction: report all SQLs that have been performed during the request
    |   logs: report all logs that were created in the request
    |
    */
    'events' => env('DEVQALY_EVENTS_TO_LOG', 'databaseTransactions,logs')
];
```

## Usage

You can either register middleware per route or globally. We highly recommend to register it globally

```php
// app/Http/Kernel.php

class Kernel extends HttpKernel
{
    protected $middleware = [
        Devqaly\DevqalyLaravel\Middlewares\DevqalyMiddleware::class,
    ];
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [devqaly](https://github.com/devqaly)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
