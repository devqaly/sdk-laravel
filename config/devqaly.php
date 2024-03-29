<?php

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
    'api' => env('DEVQALY_API_URL', 'https://api.devqaly.com/api'),

    /*
    |--------------------------------------------------------------------------
    | Events to log
    |--------------------------------------------------------------------------
    |
    | This value indicates which events we should keep track when a session is being recorded.
    | The possible values are databaseTransaction and logs.
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
