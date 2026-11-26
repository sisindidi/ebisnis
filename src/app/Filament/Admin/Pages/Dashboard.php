<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\DashboardStatsOverview;
use App\Filament\Admin\Widgets\LatestOrdersWidget;
use App\Filament\Admin\Widgets\OrdersChartWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            DashboardStatsOverview::class,
            OrdersChartWidget::class,
            LatestOrdersWidget::class,
        ];
    }
}
