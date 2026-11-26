<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\OrderController;

/* Livewire asset handling */
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});

// Route Utama Tampilan
Route::get('/', [OutletController::class, 'index'])->name('outlet.index');

// Route API/AJAX untuk Menu & Transaksi Order
Route::get('/outlet/{outletId}/menus', [OrderController::class, 'getMenusByOutlet']);
Route::get('/menu/{outletId}', [OrderController::class, 'showMenuPage'])->name('menu.page');
Route::get('/menu/{outletId}/pembayaran', [OrderController::class, 'showPaymentPage'])->name('menu.payment');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/order/midtrans-snap', [OrderController::class, 'createMidtransSnap'])->name('order.midtrans.snap');
Route::post('/order/midtrans-gopay', [OrderController::class, 'createMidtransGopay'])->name('order.midtrans.gopay');
Route::post('/order/midtrans-notification', [OrderController::class, 'midtransNotification'])->name('order.midtrans.notification');

// Route Fitur Cek Status Pesanan (Tracking Realtime)
Route::get('/order/track/{orderCode?}', [OrderController::class, 'showTrackingPage'])->name('order.track');
Route::get('/order/{orderCode}/status', [OrderController::class, 'getOrderStatus'])->name('order.status');
Route::post('/order/{orderCode}/update-status', [OrderController::class, 'updateOrderStatus'])->name('order.update_status');

// Route Invoice Pembayaran (Solo & Split Bill)
Route::get('/order/invoice/{orderCode}', [OrderController::class, 'showInvoicePage'])->name('order.invoice');

// Temporary DB health check
Route::get('/_health-db', function () {
    $host = (string) config('database.connections.pgsql.host');
    $user = (string) config('database.connections.pgsql.username');
    $info = [
        'php' => PHP_VERSION,
        'pdo_pgsql' => extension_loaded('pdo_pgsql'),
        'app_key_set' => ! empty(config('app.key')),
        'db_connection' => config('database.default'),
        'db_host_set' => ! empty($host) && $host !== '127.0.0.1',
        'db_host_suffix' => strlen($host) > 28 ? '...' . substr($host, -28) : $host,
        'db_port' => (string) config('database.connections.pgsql.port'),
        'db_database' => (string) config('database.connections.pgsql.database'),
        'db_username_prefix' => substr($user, 0, 12),
        'db_password_set' => ! empty(config('database.connections.pgsql.password')),
        'db_sslmode' => (string) config('database.connections.pgsql.sslmode'),
        'db_ok' => false,
    ];

    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $info['db_ok'] = true;
        $info['outlets_count'] = \Illuminate\Support\Facades\DB::table('outlets')->count();
        $info['menus_count'] = \Illuminate\Support\Facades\DB::table('menus')->count();
        $info['users_count'] = \Illuminate\Support\Facades\DB::table('users')->count();
    } catch (\Throwable $e) {
        $info['error_class'] = get_class($e);
        $info['error_message'] = $e->getMessage();
    }

    return response()->json($info);
});
