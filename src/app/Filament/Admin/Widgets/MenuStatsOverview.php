<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Menu;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class MenuStatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $user = Auth::user();
        $isSuperAdmin = ($user?->role === 'super_admin' || ($user && method_exists($user, 'hasRole') && $user->hasRole('super_admin')));

        $query = Menu::query();
        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $query->where('outlet_id', $user->outlet_id);
        }

        $total = (clone $query)->count();
        $tersedia = (clone $query)->where('is_available', true)->count();
        $habis = (clone $query)->where('is_available', false)->count();

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
