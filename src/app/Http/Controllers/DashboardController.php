<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Cek apakah user adalah Super Admin (sesuaikan dengan nama kolom role Anda di database)
        $isSuperAdmin = ($user->role === 'super_admin');
        
        $today = Carbon::today();

        // 1. Query dasar pesanan hari ini
        $orderQuery = Order::query()->whereDate('created_at', $today);

        // Jika Admin Outlet, batasi hanya order untuk outlet miliknya
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $orderQuery->where('outlet_id', $user->outlet_id);
        }

        // 2. Hitung Total Transaksi & Omset
        $totalPendapatan = (clone $orderQuery)
            ->whereIn('status', ['selesai', 'siap_diambil', 'sedang_disiapkan', 'dikonfirmasi'])
            ->sum('total_harga');

        $totalTransaksiBerhasil = (clone $orderQuery)
            ->whereIn('status', ['selesai', 'siap_diambil', 'sedang_disiapkan', 'dikonfirmasi'])
            ->count();

        // 3. Hitung Ringkasan Pesanan
        $totalOrder = (clone $orderQuery)->count();
        $orderAktif = (clone $orderQuery)
            ->whereIn('status', ['dikonfirmasi', 'sedang_disiapkan', 'siap_diambil'])
            ->count();
        $orderSelesai = (clone $orderQuery)->where('status', 'selesai')->count();

        // 4. Hitung Status Pesanan (Breakdown)
        $statusCounts = [
            'konfirmasi' => (clone $orderQuery)->where('status', 'dikonfirmasi')->count(),
            'disiapkan'  => (clone $orderQuery)->where('status', 'sedang_disiapkan')->count(),
            'siap'       => (clone $orderQuery)->where('status', 'siap_diambil')->count(),
            'selesai'    => $orderSelesai,
        ];

        // 5. Ambil 6 Order Terbaru
        $orderTerbaruQuery = Order::with(['user', 'outlet'])->latest();
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $orderTerbaruQuery->where('outlet_id', $user->outlet_id);
        }
        $orderTerbaru = $orderTerbaruQuery->take(6)->get();

        $orderAktifCount = $orderAktif;

        return view('dashboard', compact(
            'user',
            'isSuperAdmin',
            'totalPendapatan',
            'totalTransaksiBerhasil',
            'totalOrder',
            'orderAktif',
            'orderSelesai',
            'statusCounts',
            'orderTerbaru',
            'orderAktifCount'
        ));
    }
}
