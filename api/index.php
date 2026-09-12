<?php

// Prepare writable directories in /tmp for Vercel serverless environment
$directories = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
    '/tmp/views',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Copy pre-seeded SQLite database to writable /tmp directory
$databasePath = '/tmp/database.sqlite';
if (!file_exists($databasePath)) {
    $seededDb = __DIR__ . '/../database/database.sqlite';
    if (file_exists($seededDb)) {
        copy($seededDb, $databasePath);
    } else {
        touch($databasePath);
    }
}

// Set environment variables for serverless execution
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=' . $databasePath);
putenv('VIEW_COMPILED_PATH=/tmp/views');
putenv('APP_CONFIG_CACHE=/tmp/config.php');
putenv('APP_EVENTS_CACHE=/tmp/events.php');
putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
putenv('APP_ROUTES_CACHE=/tmp/routes.php');
putenv('APP_SERVICES_CACHE=/tmp/services.php');
putenv('CACHE_STORE=array');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');

if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:XqZdhPyuvMMVqEfzTXUEhOSbn9Zz3Z1PaQXJr7aRx64=');
}

// Forward request to Laravel public/index.php
require __DIR__ . '/../public/index.php';
