<?php

// Force production environment and TiDB settings for Vercel
if (getenv('VERCEL')) {
    $env = [
        'APP_ENV' => 'production',
        'APP_DEBUG' => 'true',

        'LOG_CHANNEL' => 'stderr',
        'SESSION_DRIVER' => 'cookie',
        'CACHE_DRIVER' => 'array',
        'VIEW_COMPILED_PATH' => '/tmp',
        'DB_CONNECTION' => 'mysql',
        'DB_HOST' => 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com',
        'DB_PORT' => '4000',
        'DB_DATABASE' => 'test',
        'DB_USERNAME' => '3HmEguLRggppLdM.root',
        'DB_PASSWORD' => 'bjihRFNq2ZQgh0Yz',
        'MYSQL_ATTR_SSL_CA' => '/etc/pki/tls/certs/ca-bundle.crt',
    ];

    foreach ($env as $key => $value) {
        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}


use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
