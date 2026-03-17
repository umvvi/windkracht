<?php

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->useEnvironmentPath(dirname(__DIR__));
$app->loadEnvironmentFrom('.env');

// Create config repository and load all configs
$config = new Illuminate\Config\Repository();

// Load configuration files
$configPath = $app->configPath();
if (is_dir($configPath)) {
    foreach (glob($configPath . '/*.php') as $configFile) {
        $config->set(basename($configFile, '.php'), require $configFile);
    }
}

$app->instance('config', $config);

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

return $app;
