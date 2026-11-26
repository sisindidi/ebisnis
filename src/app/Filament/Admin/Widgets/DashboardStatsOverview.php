<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Menu;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DashboardStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = Auth::user();
        $isSuperAdmin = ($user?->role === 'super_admin' || ($user && method_exists($user, 'hasRole') && $user->hasRole('super_admin')));

        // Menu query
        $menuQuery = Menu::query();
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $menuQuery->where('outlet_id', $user->outlet_id);
        }

        $totalMenu = (clone $menuQuery)->count();
        $menuTersedia = (clone $menuQuery)->where('is_available', true)->count();
        $menuHabis = (clone $menuQuery)->where('is_available', false)->count();

        // Order query
        $orderQuery = Order::query();
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $orderQuery->where('outlet_id', $user->outlet_id);
        }

        $totalPesanan = (clone $orderQuery)->count();
        $pesananHariIni = (clone $orderQuery)->whereDate('created_at', today())->count();

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
