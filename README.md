# Allow your Laravel application to send events while a session is being recorded

<div align="center">
  <a href="https://devqaly.com" target="_blank">
  <picture>
    <source media="(prefers-color-scheme: dark)" srcset="./assets/images/logo.svg">
    <img src="https://github.com/devqaly/devqaly/raw/master/assets/images/logo.svg" width="280" alt="Logo"/>
  </picture>
  </a>
</div>

<h1 align="center">
You record your screen, while Devqaly records important events for easier and faster debugging
</h1>

<div align="center">
The ultimate service allowing your developers or quality assurance engineers to record their screens while Devqaly 
records important information such as network requests, clicks, console logs, database transactions and many more.
</div>

<p align="center">
    <br />
    <a href="https://docs.devqaly.com" rel="dofollow"><strong>Explore the docs »</strong></a>
    <br />
</p>

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
    'events' => env('DEVQALY_EVENTS_TO_LOG', 'databaseTransactions,logs'),
    
    /*
    |--------------------------------------------------------------------------
    | Security token
    |--------------------------------------------------------------------------
    |
    | You should be able to see this value in your project's settings page.
    | This value will authenticate your backend in Devqaly's backend servers.
    |
    */
    'securityToken' => env('DEVQALY_SECURITY_TOKEN'),
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

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [devqaly](https://github.com/devqaly)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
