<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class OrdersChartWidget extends ChartWidget
{
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;
    protected static ?string $heading = 'Grafik Aktivitas Pesanan (7 Hari Terakhir)';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = Auth::user();
        $isSuperAdmin = ($user?->role === 'super_admin' || ($user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()));

        $days = collect(range(6, 0))->map(fn ($i) => Carbon::today()->subDays($i));
        $labels = $days->map(fn ($date) => $date->format('d M'))->toArray();

        $startDate = Carbon::today()->subDays(6)->startOfDay();
        $rows = Order::query()
            ->where('created_at', '>=', $startDate)
            ->when(! $isSuperAdmin && isset($user->outlet_id), fn ($q) => $q->where('outlet_id', $user->outlet_id))
            ->selectRaw('CAST(created_at AS DATE) as order_date, COUNT(*) as total')
            ->groupByRaw('CAST(created_at AS DATE)')
            ->get();

        $countsByDate = [];
        foreach ($rows as $row) {
            $countsByDate[substr((string) $row->order_date, 0, 10)] = (int) $row->total;
        }

        $data = $days->map(fn ($date) => $countsByDate[$date->format('Y-m-d')] ?? 0)->toArray();

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
