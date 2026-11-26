<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class OrdersChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafik Aktivitas Pesanan (7 Hari Terakhir)';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = Auth::user();
        $isSuperAdmin = ($user?->role === 'super_admin' || ($user && method_exists($user, 'hasRole') && $user->hasRole('super_admin')));

        $days = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i);
        });

        $labels = $days->map(fn ($date) => $date->format('d M'))->toArray();

        $data = $days->map(function ($date) use ($user, $isSuperAdmin) {
            $query = Order::query()->whereDate('created_at', $date);
            if (! $isSuperAdmin && isset($user->outlet_id)) {
                $query->where('outlet_id', $user->outlet_id);
            }
            return $query->count();
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pesanan',
                    'data' => $data,
                    'borderColor' => '#0875BD',
                    'backgroundColor' => 'rgba(8, 117, 189, 0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                    'borderWidth' => 2.5,
                    'pointBackgroundColor' => '#0875BD',
                    'pointBorderColor' => '#FFFFFF',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
