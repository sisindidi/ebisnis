<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Menu;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DashboardStatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = Auth::user();
        $isSuperAdmin = ($user?->role === 'super_admin' || ($user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()));

        // Menu stats (1 aggregate query instead of 3)
        $menuQuery = Menu::query();
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $menuQuery->where('outlet_id', $user->outlet_id);
        }

        $menuStats = $menuQuery
            ->selectRaw('COUNT(*) as total, COALESCE(SUM(CASE WHEN is_available = true THEN 1 ELSE 0 END), 0) as tersedia, COALESCE(SUM(CASE WHEN is_available = false THEN 1 ELSE 0 END), 0) as habis')
            ->first();

        $totalMenu = (int) ($menuStats->total ?? 0);
        $menuTersedia = (int) ($menuStats->tersedia ?? 0);
        $menuHabis = (int) ($menuStats->habis ?? 0);

        // Order stats (1 aggregate query instead of 2)
        $orderQuery = Order::query();
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $orderQuery->where('outlet_id', $user->outlet_id);
        }

        $todayStart = today()->startOfDay();
        $orderStats = $orderQuery
            ->selectRaw('COUNT(*) as total, COALESCE(SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END), 0) as today', [$todayStart])
            ->first();

        $totalPesanan = (int) ($orderStats->total ?? 0);
        $pesananHariIni = (int) ($orderStats->today ?? 0);

        return [
            Stat::make('Total Menu', (string) $totalMenu)
                ->description('Semua varian menu terdaftar')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('primary')
                ->chart([3, 5, 4, 7, 6, 8, max(5, $totalMenu)]),

            Stat::make('Menu Tersedia', (string) $menuTersedia)
                ->description('Siap dipesan mahasiswa')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success')
                ->chart([2, 4, 3, 5, 6, 7, max(4, $menuTersedia)]),

            Stat::make('Menu Habis', (string) $menuHabis)
                ->description('Stok menu sedang kosong')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger')
                ->chart([1, 2, 0, 1, 0, 1, max(1, $menuHabis)]),

            Stat::make('Total Pesanan', (string) $totalPesanan)
                ->description("{$pesananHariIni} pesanan baru hari ini")
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning')
                ->chart([2, 5, 8, 4, 9, 12, max(6, $totalPesanan)]),
        ];
    }
}
