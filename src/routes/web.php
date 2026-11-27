<?php

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
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

// Halaman & API publik pelanggan tidak membutuhkan session database (state keranjang di localStorage),
// sehingga menghilangkan query SELECT/UPDATE tabel sessions di setiap buka halaman dan polling.
Route::withoutMiddleware([
    StartSession::class,
    ShareErrorsFromSession::class,
    VerifyCsrfToken::class,
])->group(function () {
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
});
