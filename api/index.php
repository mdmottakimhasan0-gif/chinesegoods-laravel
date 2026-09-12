<?php

// Prepare writable directories in /tmp for Vercel serverless environment
$directories = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

// Ensure SQLite database exists and is writable in /tmp
$databasePath = '/tmp/database.sqlite';
if (! file_exists($databasePath)) {
    $seededDb = __DIR__.'/../database/database.sqlite';
    if (file_exists($seededDb)) {
        copy($seededDb, $databasePath);
    } else {
        touch($databasePath);
    }
}

$envVars = [
    'APP_NAME' => 'Chinese Goods BD',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'true',
    'APP_KEY' => 'base64:XqZdhPyuvMMVqEfzTXUEhOSbn9Zz3Z1PaQXJr7aRx64=',
    'APP_URL' => 'https://'.($_SERVER['HTTP_HOST'] ?? 'localhost'),
    'LARAVEL_STORAGE_PATH' => '/tmp/storage',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'APP_CONFIG_CACHE' => '/tmp/bootstrap/cache/config.php',
    'APP_EVENTS_CACHE' => '/tmp/bootstrap/cache/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
    'APP_ROUTES_CACHE' => '/tmp/bootstrap/cache/routes.php',
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => $databasePath,
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE' => 'array',
    'APP_MAINTENANCE_DRIVER' => 'file',
    'LOG_CHANNEL' => 'stderr',
];

foreach ($envVars as $key => $value) {
    putenv("{$key}={$value}");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// Forward request to Laravel public/index.php
require __DIR__.'/../public/index.php';
