<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class LatestOrdersWidget extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Ringkasan Pesanan Terbaru';

    public function table(Table $table): Table
    {
        $user = Auth::user();
        $isSuperAdmin = ($user?->role === 'super_admin' || ($user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()));

        $query = Order::query()->with('outlet:id,name')->latest();

        if (! $isSuperAdmin && isset($user->outlet_id)) {
            $query->where('outlet_id', $user->outlet_id);
        }

        return $table
            ->query($query)
            ->defaultPaginationPageOption(5)
            ->columns([
                // Kode Order & Pemesan
                Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Order')
                    ->weight('bold')
                    ->color('primary')
                    ->searchable(),

                // Outlet (Hanya Super Admin)
                Tables\Columns\TextColumn::make('outlet.name')
                    ->label('Outlet')
                    ->visible($isSuperAdmin)
                    ->badge()
                    ->color('gray'),

                // Layanan
                Tables\Columns\TextColumn::make('service_type')
                    ->label('Layanan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dine_in' => 'info',
                        'take_away' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dine_in' => 'Dine In',
                        'take_away' => 'Take Away',
                        default => ucfirst($state),
                    }),

                // Total Harga
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->formatStateUsing(fn ($state) => 'Rp' . number_format((float) $state, 0, ',', '.'))
                    ->weight('extrabold'),

                // Status Pesanan (Badge Berwarna Soft)
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'ready', 'siap_diambil'                => 'info',
                        'paid', 'completed', 'done', 'selesai' => 'success',
                        'cooking', 'processing', 'preparing'   => 'warning',
                        'pending', 'unpaid'                    => 'danger',
                        default                                => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match (strtolower($state)) {
                        'ready'      => 'Siap Diambil',
                        'paid'       => 'Pembayaran Berhasil',
                        'cooking'    => 'Sedang Dimasak',
                        'processing' => 'Sedang Diproses',
                        'completed'  => 'Selesai',
                        'pending'    => 'Menunggu Bayar',
                        default      => ucfirst($state),
                    }),

                // Waktu Order
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->time('H:i')
                    ->suffix(' WIB'),
            ]);
    }
}
