<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Vercel serverless filesystem is read-only outside /tmp.
// Ensure writable directories exist for Laravel caches, views, sessions, and logs.
$tmpDirs = [
    '/tmp/bootstrap/cache',
    '/tmp/storage/app/private',
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($tmpDirs as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL')) {
    $app->useStoragePath('/tmp/storage');
}

$app->handleRequest(Request::capture());
