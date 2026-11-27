<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Menu;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class MenuStatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $user = Auth::user();
        $isSuperAdmin = ($user?->role === 'super_admin' || ($user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()));

        $query = Menu::query();
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $query->where('outlet_id', $user->outlet_id);
        }

        $stats = $query
            ->selectRaw('COUNT(*) as total, COALESCE(SUM(CASE WHEN is_available = true THEN 1 ELSE 0 END), 0) as tersedia, COALESCE(SUM(CASE WHEN is_available = false THEN 1 ELSE 0 END), 0) as habis')
            ->first();

        $total = (int) ($stats->total ?? 0);
        $tersedia = (int) ($stats->tersedia ?? 0);
        $habis = (int) ($stats->habis ?? 0);

        return [
            Stat::make('Total Menu', (string) $total)
                ->description('Seluruh menu di katalog')
                ->descriptionIcon('heroicon-m-rectangle-stack')
                ->color('primary'),

            Stat::make('Menu Tersedia', (string) $tersedia)
                ->description('Aktif dan dapat dipesan pelanggan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Menu Habis', (string) $habis)
                ->description('Stok habis (tidak dapat dipesan)')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
