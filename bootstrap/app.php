<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

class VercelApplication extends Illuminate\Foundation\Application
{
    public function __construct($basePath = null)
    {
        if (isset($_SERVER['VERCEL'])) {
            die("VercelApplication is running");

        }
        parent::__construct($basePath);
    }

    public function getCachedPackagesPath(): string
    {
        return '/tmp/laravel_packages.php';
    }

    public function getCachedServicesPath(): string
    {
        return '/tmp/laravel_services.php';
    }

    public function getCachedConfigPath(): string
    {
        return '/tmp/laravel_config.php';
    }

    public function getCachedRoutesPath(): string
    {
        return '/tmp/laravel_routes.php';
    }

}

$app = new VercelApplication(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);


/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
