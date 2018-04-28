<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Debugbar Settings
     |--------------------------------------------------------------------------
     |
     | Debugbar is enabled by default, when debug is set to true in app.php.
     | You can override the value by setting enable to true or false instead of null.
     |
     */

    'enabled' => null,

    /*
     |--------------------------------------------------------------------------
     | Storage settings
     |--------------------------------------------------------------------------
     |
     | DebugBar stores data for session/ajax requests.
     | You can disable this, so the debugbar stores data in headers/session,
     | but this can cause problems with large data collectors.
     | By default, file storage (in the storage folder) is used. Redis and PDO
     | can also be used. For PDO, run the package migrations first.
     |
     */
    'storage' => [
        'enabled'    => true,
        'driver'     => 'file', // redis, file, pdo, custom
        'path'       => storage_path('debugbar'), // For file driver
        'connection' => null,   // Leave null for default connection (Redis/PDO)
        'provider'   => '' // Instance of StorageInterface for custom driver
    ],

    /*
     |--------------------------------------------------------------------------
     | Vendors
     |--------------------------------------------------------------------------
     |
     | Vendor files are included by default, but can be set to false.
     | This can also be set to 'js' or 'css', to only include javascript or css vendor files.
     | Vendor files are for css: font-awesome (including fonts) and highlight.js (css files)
     | and for js: jquery and and highlight.js
     | So if you want syntax highlighting, set it to true.
     | jQuery is set to not conflict with existing jQuery scripts.
     |
     */

    'include_vendors' => true,

    /*
     |--------------------------------------------------------------------------
     | Capture Ajax Requests
     |--------------------------------------------------------------------------
     |
     | The Debugbar can capture Ajax requests and display them. If you don't want this (ie. because of errors),
     | you can use this option to disable sending the data through the headers.
     |
     */

    'capture_ajax' => true,

    /*
     |--------------------------------------------------------------------------
     | Clockwork integration
     |--------------------------------------------------------------------------
     |
     | The Debugbar can emulate the Clockwork headers, so you can use the Chrome
     | Extension, without the server-side code. It uses Debugbar collectors instead.
     |
     */
    'clockwork' => false,

    /*
     |--------------------------------------------------------------------------
     | DataCollectors
     |--------------------------------------------------------------------------
     |
     | Enable/disable DataCollectors
     |
     */

    'collectors' => [
        'phpinfo'         => env('DEBUGBAR_PHPINFO', true),  // Php version
        'messages'        => env('DEBUGBAR_MESSAGES', true),  // Messages
        'time'            => env('DEBUGBAR_TIME', true),  // Time Datalogger
        'memory'          => env('DEBUGBAR_MEMORY', true),  // Memory usage
        'exceptions'      => env('DEBUGBAR_EXCEPTIONS', true),  // Exception displayer
        'log'             => env('DEBUGBAR_LOG', true),  // Logs from Monolog (merged in messages if enabled)
        'db'              => env('DEBUGBAR_DATABASE', true),  // Show database (PDO) queries and bindings
        'views'           => env('DEBUGBAR_VIEWS', true),  // Views with their data
        'route'           => env('DEBUGBAR_ROUTE', true),  // Current route information
        'laravel'         => env('DEBUGBAR_LARAVEL', false), // Laravel version and environment
        'events'          => env('DEBUGBAR_EVENTS', true), // All events fired
        'default_request' => env('DEBUGBAR_REQUEST', false), // Regular or special Symfony request logger
        'symfony_request' => env('DEBUGBAR_SYMPHONYREQUESTS', true),  // Only one can be enabled..
        'mail'            => env('DEBUGBAR_MAIL', true),  // Catch mail messages
        'logs'            => env('DEBUGBAR_LOGS', false), // Add the latest log messages
        'files'           => env('DEBUGBAR_FILES', false), // Show the included files
        'config'          => env('DEBUGBAR_CONFIG', false), // Display config settings
        'auth'            => env('DEBUGBAR_AUTH', true), // Display Laravel authentication status
        'gate'            => env('DEBUGBAR_GATE', false), // Display Laravel Gate checks
        'session'         => env('DEBUGBAR_SESSION', true),  // Display session data
    ],

    /*
     |--------------------------------------------------------------------------
     | Extra options
     |--------------------------------------------------------------------------
     |
     | Configure some DataCollectors
     |
     */

    'options' => [
        'auth' => [
            'show_name' => false,   // Also show the users name/email in the debugbar
        ],
        'db' => [
            'with_params'       => true,   // Render SQL with the parameters substituted
            'timeline'          => false,  // Add the queries to the timeline
            'backtrace'         => false,  // EXPERIMENTAL: Use a backtrace to find the origin of the query in your files.
            'explain' => [                 // EXPERIMENTAL: Show EXPLAIN output on queries
                'enabled' => false,
                'types' => ['SELECT'],     // ['SELECT', 'INSERT', 'UPDATE', 'DELETE']; for MySQL 5.6.3+
            ],
            'hints'             => true,    // Show hints for common mistakes
        ],
        'mail' => [
            'full_log' => false
        ],
        'views' => [
            'data' => false,    //Note: Can slow down the application, because the data can be quite large..
        ],
        'route' => [
            'label' => true  // show complete route on bar
        ],
        'logs' => [
            'file' => null
        ],
    ],

    /*
     |--------------------------------------------------------------------------
     | Inject Debugbar in Response
     |--------------------------------------------------------------------------
     |
     | Usually, the debugbar is added just before </body>, by listening to the
     | Response after the App is done. If you disable this, you have to add them
     | in your template yourself. See http://phpdebugbar.com/docs/rendering.html
     |
     */

    'inject' => true,

    /*
     |--------------------------------------------------------------------------
     | DebugBar route prefix
     |--------------------------------------------------------------------------
     |
     | Sometimes you want to set route prefix to be used by DebugBar to load
     | its resources from. Usually the need comes from misconfigured web server or
     | from trying to overcome bugs like this: http://trac.nginx.org/nginx/ticket/97
     |
     */
    'route_prefix' => '_debugbar',

];
