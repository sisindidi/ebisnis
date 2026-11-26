<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Mengambil daftar menu berdasarkan outlet_id
    public function getMenusByOutlet($outletId)
    {
        $menus = Menu::where('outlet_id', $outletId)
                    ->orderBy('is_available', 'desc')
                    ->get();

        return response()->json($menus);
    }

    // Menampilkan halaman menu
    public function showMenuPage($outletId)
    {
        $outlet = Outlet::find($outletId);
        if (!$outlet) {
            $fallbackNames = [
                1 => 'Esa Corner',
                2 => 'Kantin Mamici',
                3 => 'Kantin Teh Nur',
                4 => 'Kedai Bu Yanti',
            ];
            $outlet = (object)[
                'id' => (int)$outletId,
                'name' => $fallbackNames[$outletId] ?? 'Outlet Kantin',
            ];
        }

        $menus = Menu::where('outlet_id', $outletId)
                    ->orderBy('is_available', 'desc')
                    ->get();

        return view('menu', compact('menus', 'outlet'));
    }

    // Menampilkan halaman baru pembayaran QRIS (bukan popup)
    public function showPaymentPage($outletId)
    {
        $outlet = Outlet::find($outletId);
        if (!$outlet) {
            $fallbackNames = [
                1 => 'Esa Corner',
                2 => 'Kantin Mamici',
                3 => 'Kantin Teh Nur',
                4 => 'Kedai Bu Yanti',
            ];
            $outlet = (object)[
                'id' => (int)$outletId,
                'name' => $fallbackNames[$outletId] ?? 'Outlet Kantin',
            ];
        }

        return view('payment', compact('outlet'));
    }

    // Membuat Snap Token Midtrans & menyimpan pesanan (status: pending)
    public function createMidtransSnap(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required',
            'order_type' => 'required|in:solo,group',
            'service_type' => 'required|in:dine_in,take_away',
            'items' => 'required|array|min:1',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer',
        ]);

        $orderCode = 'ORD-' . strtoupper(Str::random(6));
        $totalPrice = 0;
        $itemDetails = [];

        foreach ($request->items as $item) {
            $qty = (int)$item['quantity'];
            $price = (int)$item['price'];
            $totalPrice += $price * $qty;
            $menuId = (string)($item['menu_id'] ?? $item['id'] ?? 1);
            $itemDetails[] = [
                'id' => $menuId,
                'price' => $price,
                'quantity' => $qty,
                'name' => mb_substr($item['name'] ?? 'Menu Kantin', 0, 50),
            ];
        }

        // 1. Simpan Header Order (status: pending menunggu konfirmasi bayar)
        $order = Order::create([
            'outlet_id' => $request->outlet_id,
            'order_code' => $orderCode,
            'order_type' => $request->order_type,
            'service_type' => $request->service_type,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // 2. Simpan Detail Item Order
        foreach ($request->items as $item) {
            $menuId = $item['menu_id'] ?? $item['id'] ?? null;
            if ($menuId) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'customer_name' => $item['customer_name'] ?? ($request->customer_name ?? 'Pelanggan'),
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
        }

        // 3. Request ke Midtrans Snap API
        $serverKey = config('services.midtrans.server_key', 'SB-Mid-server-j0ljzkyhpqU18nUwMSjy.LNa');
        $isProduction = config('services.midtrans.is_production', false);
        $snapUrl = $isProduction 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $customerName = $request->customer_name ?? 'Pelanggan Kantin';
        $payload = [
            'transaction_details' => [
                'order_id' => $orderCode,
                'gross_amount' => $totalPrice,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $customerName,
                'email' => 'pelanggan@kantinkampus.ac.id',
            ],
            'callbacks' => [
                'finish' => url('/order/track/' . $orderCode),
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
            ])->post($snapUrl, $payload);

            if ($response->successful()) {
                $resData = $response->json();
                return response()->json([
                    'success' => true,
                    'order_code' => $orderCode,
                    'order_id' => $order->id,
                    'snap_token' => $resData['token'] ?? null,
                    'redirect_url' => $resData['redirect_url'] ?? null,
                ]);
            }

            Log::error('Midtrans Snap Error: ' . $response->body());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan token Midtrans: ' . $response->body(),
                'order_code' => $orderCode,
            ], 500);
        } catch (\Exception $e) {
            Log::error('Midtrans Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Koneksi ke Midtrans bermasalah: ' . $e->getMessage(),
                'order_code' => $orderCode,
            ], 500);
        }
    }

    // Midtrans Webhook / Callback Notification
    public function midtransNotification(Request $request)
    {
        $payload = $request->all();
        $orderCode = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderCode) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($transactionStatus === 'capture') {
            if ($fraudStatus === 'accept') {
                $order->update(['status' => 'paid']);
            }
        } elseif ($transactionStatus === 'settlement') {
            $order->update(['status' => 'paid']);
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $order->update(['status' => 'pending']);
        }

        return response()->json(['status' => 'success']);
    }


    // Membuat transaksi GoPay Deeplink (Langsung ke Simulator Midtrans seperti di foto)
    public function createMidtransGopay(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required',
            'order_type' => 'required|in:solo,group',
            'service_type' => 'required|in:dine_in,take_away',
            'items' => 'required|array|min:1',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer',
        ]);

        $orderCode = 'ORD-' . strtoupper(Str::random(6));
        $totalPrice = 0;
        $itemDetails = [];

        foreach ($request->items as $item) {
            $qty = (int)$item['quantity'];
            $price = (int)$item['price'];
            $totalPrice += $price * $qty;
            $menuId = (string)($item['menu_id'] ?? $item['id'] ?? 1);
            $itemDetails[] = [
                'id' => $menuId,
                'price' => $price,
                'quantity' => $qty,
                'name' => mb_substr($item['name'] ?? 'Menu Kantin', 0, 50),
            ];
        }

        $order = Order::create([
            'outlet_id' => $request->outlet_id,
            'order_code' => $orderCode,
            'order_type' => $request->order_type,
            'service_type' => $request->service_type,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
            $menuId = $item['menu_id'] ?? $item['id'] ?? null;
            if ($menuId) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'customer_name' => $item['customer_name'] ?? ($request->customer_name ?? 'Pelanggan'),
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
        }

        $serverKey = config('services.midtrans.server_key', 'SB-Mid-server-j0ljzkyhpqU18nUwMSjy.LNa');
        $isProduction = config('services.midtrans.is_production', false);
        $chargeUrl = $isProduction 
            ? 'https://api.midtrans.com/v2/charge' 
            : 'https://api.sandbox.midtrans.com/v2/charge';

        $customerName = $request->customer_name ?? 'Pelanggan Kantin';
        $payload = [
            'payment_type' => 'gopay',
            'transaction_details' => [
                'order_id' => $orderCode,
                'gross_amount' => $totalPrice,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $customerName,
                'email' => 'pelanggan@kantinkampus.ac.id',
            ],
            'gopay' => [
                'enable_callback' => true,
                'callback_url' => url('/order/track/' . $orderCode),
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
            ])->post($chargeUrl, $payload);

            if ($response->successful()) {
                $resData = $response->json();
                $actions = $resData['actions'] ?? [];
                $deeplinkUrl = null;
                $qrCodeUrl = null;

                foreach ($actions as $action) {
                    if ($action['name'] === 'deeplink-redirect') {
                        $deeplinkUrl = $action['url'];
                    } elseif ($action['name'] === 'generate-qr-code') {
                        $qrCodeUrl = $action['url'];
                    }
                }

                return response()->json([
                    'success' => true,
                    'order_code' => $orderCode,
                    'order_id' => $order->id,
                    'deeplink_url' => $deeplinkUrl,
                    'qr_code_url' => $qrCodeUrl,
                ]);
            }

            Log::error('Midtrans Gopay Error: ' . $response->body());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses GoPay: ' . $response->body(),
            ], 500);
        } catch (\Exception $e) {
            Log::error('Midtrans Gopay Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Koneksi Midtrans error: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Menyimpan pesanan dan item pesanan ke database
    public function store(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'order_type' => 'required|in:solo,group',
            'service_type' => 'required|in:dine_in,take_away',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.customer_name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer',
            'status' => 'nullable|in:pending,paid,cooking,ready,completed',
        ]);

        $orderCode = 'ORD-' . strtoupper(Str::random(6));
        $totalPrice = 0;

        foreach ($request->items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Status awal setelah pembayaran QRIS dikonfirmasi adalah 'paid' (Pembayaran Berhasil)
        $status = $request->input('status', 'paid');

        // 1. Simpan Header Order
        $order = Order::create([
            'outlet_id' => $request->outlet_id,
            'order_code' => $orderCode,
            'order_type' => $request->order_type,
            'service_type' => $request->service_type,
            'total_price' => $totalPrice,
            'status' => $status,
        ]);

        // 2. Simpan Detail Item Order
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['menu_id'],
                'customer_name' => $item['customer_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Pesanan berhasil dibuat',
            'order_code' => $order->order_code,
            'order_id' => $order->id,
            'status' => $order->status,
            'invoice_url' => route('order.invoice', $order->order_code)
        ], 201);
    }

    // Mengambil status dan rincian pesanan secara realtime
    public function getOrderStatus($orderCode)
    {
        $order = Order::with(['outlet', 'items.menu'])
            ->where('order_code', $orderCode)
            ->first();

        if ($order && $order->status === 'pending') {
            try {
                $serverKey = config('services.midtrans.server_key', 'SB-Mid-server-j0ljzkyhpqU18nUwMSjy.LNa');
                $isProduction = config('services.midtrans.is_production', false);
                $midtransStatusUrl = ($isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/') . $orderCode . '/status';
                $midtransRes = Http::timeout(2)->withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
                ])->get($midtransStatusUrl);
                if ($midtransRes->successful()) {
                    $mStatus = $midtransRes->json('transaction_status');
                    $mFraud = $midtransRes->json('fraud_status');
                    if ($mStatus === 'settlement' || ($mStatus === 'capture' && $mFraud === 'accept')) {
                        $order->update(['status' => 'paid']);
                        $order->refresh();
                    }
                }
            } catch (\Exception $e) {}
        }

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan dengan kode ' . $orderCode . ' tidak ditemukan.'
            ], 404);
        }

        $statusInfo = [
            'pending' => [
                'step' => 0,
                'label' => 'Menunggu Pembayaran',
                'desc' => 'Menunggu proses verifikasi pembayaran QRIS.',
                'color' => '#f59e0b',
                'badge_class' => 'status-pending'
            ],
            'paid' => [
                'step' => 1,
                'label' => 'Pembayaran Berhasil',
                'desc' => 'Pembayaran lunas terverifikasi! Pesanan Anda telah diteruskan ke dapur kantin.',
                'color' => '#10b981',
                'badge_class' => 'status-paid'
            ],
            'cooking' => [
                'step' => 2,
                'label' => 'Menyiapkan Pesanan',
                'desc' => 'Koki sedang memasak & meracik hidangan lezatmu dengan higienis.',
                'color' => '#f97316',
                'badge_class' => 'status-cooking'
            ],
            'ready' => [
                'step' => 3,
                'label' => 'Pesanan Siap Diambil',
                'desc' => 'Hore! Makananmu sudah siap. Silakan ambil di kasir/counter kantin!',
                'color' => '#059669',
                'badge_class' => 'status-ready'
            ],
            'completed' => [
                'step' => 4,
                'label' => 'Pesanan Selesai',
                'desc' => 'Pesanan telah diambil. Selamat menikmati santapan lezatmu!',
                'color' => '#3b82f6',
                'badge_class' => 'status-completed'
            ],
        ];

        $currentStatus = $statusInfo[$order->status] ?? $statusInfo['paid'];

        return response()->json([
            'success' => true,
            'order' => [
                'id' => $order->id,
                'order_code' => $order->order_code,
                'status' => $order->status,
                'step' => $currentStatus['step'],
                'status_label' => $currentStatus['label'],
                'status_desc' => $currentStatus['desc'],
                'status_color' => $currentStatus['color'],
                'badge_class' => $currentStatus['badge_class'],
                'order_type' => $order->order_type,
                'order_type_label' => $order->order_type === 'solo' ? 'Pesan Sendiri' : 'Pesan Bersama (Split Bill)',
                'service_type' => $order->service_type,
                'service_type_label' => $order->service_type === 'dine_in' ? 'Dine in' : 'Take Away',
                'total_price' => $order->total_price,
                'formatted_total' => 'Rp ' . number_format($order->total_price, 0, ',', '.'),
                'outlet_id' => $order->outlet_id,
                'outlet_name' => $order->outlet ? $order->outlet->name : 'Kantin Kampus',
                'created_at' => $order->created_at ? $order->created_at->format('d M Y, H:i') : '-',
                'created_time' => $order->created_at ? $order->created_at->format('H:i') : '-',
                'items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'menu_id' => $item->menu_id,
                        'menu_name' => $item->menu ? $item->menu->name : 'Menu',
                        'customer_name' => $item->customer_name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'subtotal' => $item->subtotal,
                        'formatted_price' => 'Rp ' . number_format($item->price, 0, ',', '.'),
                        'formatted_subtotal' => 'Rp ' . number_format($item->subtotal, 0, ',', '.'),
                    ];
                }),
            ]
        ]);
    }

    // Update status pesanan (digunakan oleh admin / simulasi demo koki kantin)
    public function updateOrderStatus(Request $request, $orderCode)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,cooking,ready,completed',
        ]);

        $order = Order::where('order_code', $orderCode)->first();
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan'
            ], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diubah menjadi ' . $order->status,
            'status' => $order->status
        ]);
    }

    // Menampilkan halaman pelacakan status pesanan
    public function showTrackingPage($orderCode = null)
    {
        $order = null;
        if ($orderCode) {
            $order = Order::with(['outlet', 'items.menu'])->where('order_code', $orderCode)->first();
            if ($order && $order->status === 'pending') {
                try {
                    $serverKey = config('services.midtrans.server_key', 'SB-Mid-server-j0ljzkyhpqU18nUwMSjy.LNa');
                    $isProduction = config('services.midtrans.is_production', false);
                    $midtransStatusUrl = ($isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/') . $orderCode . '/status';
                    $midtransRes = Http::timeout(3)->withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
                    ])->get($midtransStatusUrl);
                    if ($midtransRes->successful()) {
                        $mStatus = $midtransRes->json('transaction_status');
                        $mFraud = $midtransRes->json('fraud_status');
                        if ($mStatus === 'settlement' || ($mStatus === 'capture' && $mFraud === 'accept')) {
                            $order->update(['status' => 'paid']);
                            $order->refresh();
                        }
                    }
                } catch (\Exception $e) {}
            }
        }
        return view('order-track', compact('orderCode', 'order'));
    }

    // Menampilkan halaman invoice resmi setelah pembayaran (baik Solo maupun Split Bill)
    public function showInvoicePage($orderCode)
    {
        $order = Order::with(['outlet', 'items.menu'])
            ->where('order_code', $orderCode)
            ->first();

        if ($order && $order->status === 'pending') {
            try {
                $serverKey = config('services.midtrans.server_key', 'SB-Mid-server-j0ljzkyhpqU18nUwMSjy.LNa');
                $isProduction = config('services.midtrans.is_production', false);
                $midtransStatusUrl = ($isProduction ? 'https://api.midtrans.com/v2/' : 'https://api.sandbox.midtrans.com/v2/') . $orderCode . '/status';
                $midtransRes = Http::timeout(2)->withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
                ])->get($midtransStatusUrl);
                if ($midtransRes->successful()) {
                    $mStatus = $midtransRes->json('transaction_status');
                    $mFraud = $midtransRes->json('fraud_status');
                    if ($mStatus === 'settlement' || ($mStatus === 'capture' && $mFraud === 'accept')) {
                        $order->update(['status' => 'paid']);
                        $order->refresh();
                    }
                }
            } catch (\Exception $e) {}
        }

        if (!$order) {
            abort(404, 'Pesanan dengan kode ' . $orderCode . ' tidak ditemukan.');
        }

        // Kelompokkan item berdasarkan nama pemesan (sangat berguna untuk Split Bill)
        $itemsByCustomer = $order->items->groupBy('customer_name');

        // Ringkasan per pemesan
        $customerSummary = $itemsByCustomer->map(function ($items, $name) {
            return [
                'name' => $name,
                'items' => $items,
                'total' => $items->sum('subtotal'),
                'total_qty' => $items->sum('quantity'),
            ];
        });

        return view('invoice', compact('order', 'itemsByCustomer', 'customerSummary'));
    }
}
