<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/health-db', function () {
    $host = (string) config('database.connections.pgsql.host');
    $info = [
        'php' => PHP_VERSION,
        'pdo_pgsql' => extension_loaded('pdo_pgsql'),
        'app_key_set' => ! empty(config('app.key')),
        'db_connection' => config('database.default'),
        'db_host_set' => ! empty($host) && $host !== '127.0.0.1',
        'db_host_suffix' => strlen($host) > 24 ? '...' . substr($host, -24) : $host,
        'db_port' => (string) config('database.connections.pgsql.port'),
        'db_database' => (string) config('database.connections.pgsql.database'),
        'db_sslmode' => (string) config('database.connections.pgsql.sslmode'),
        'session_driver' => (string) config('session.driver'),
        'db_ok' => false,
    ];

    try {
        DB::connection()->getPdo();
        $info['db_ok'] = true;
        $info['outlets_count'] = DB::table('outlets')->count();
        $info['menus_count'] = DB::table('menus')->count();
        $info['users_count'] = DB::table('users')->count();
    } catch (\Throwable $e) {
        $info['error_class'] = get_class($e);
        $info['error_message'] = $e->getMessage();
    }

    return response()->json($info);
});
