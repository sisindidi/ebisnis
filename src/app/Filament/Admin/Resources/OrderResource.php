<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?int $navigationSort = 4;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (! auth()->user()?->hasRole('super_admin') && auth()->user()->outlet_id) {
            $query->where('outlet_id', auth()->user()->outlet_id);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_code')
                    ->label('Kode Pesanan')
                    ->disabled(),

                Forms\Components\Select::make('outlet_id')
                    ->relationship('outlet', 'name')
                    ->disabled(),

                Forms\Components\Select::make('order_type')
                    ->options([
                        'solo' => 'Pesan Sendiri',
                        'group' => 'Pesan Bersama (Split Bill)',
                    ])
                    ->disabled(),

                Forms\Components\Select::make('service_type')
                    ->options([
                        'dine_in' => 'Dine In',
                        'take_away' => 'Take Away',
                    ])
                    ->disabled(),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->label('Status Pesanan')
                    ->options([
                        'pending' => 'Menunggu Pembayaran',
                        'paid' => 'Pembayaran Berhasil',
                        'cooking' => 'Menyiapkan Pesanan',
                        'ready' => 'Pesanan Siap Diambil',
                        'completed' => 'Pesanan Selesai',
                    ])
                    ->required(),

                // Display items in form
                Forms\Components\Repeater::make('items')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')->label('Pemesan('),
                        Forms\Components\Select::make('menu_id')
                            ->relationship('menu', 'name')
                            ->label('Menu'),
                        Forms\Components\TextInput::make('quantity')->numeric()->label('Qty'),
                        Forms\Components\TextInput::make('subtotal')->numeric()->prefix('Rp')->label('Subtotal'),
                    ])
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label('Kode Order')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('outlet.name')
                    ->label('Outlet')
                    ->sortable()
                    ->searchable()
                    ->visible(fn () => auth()->user()?->hasRole('super_admin')),

                Tables\Columns\TextColumn::make('order_type')
                    ->label('Tipe')
                    ->badge()
                    ->colors([
                        'primary' => 'solo',
                        'warning' => 'group',
                    ]),

                Tables\Columns\TextColumn::make('service_type')
                    ->label('Layanan')
                    ->badge()
                    ->colors([
                        'info' => 'dine_in',
                        'success' => 'take_away',
                    ]),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status Realtime')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Pembayaran Berhasil',
                        'cooking' => 'Menyiapkan Pesanan',
                        'ready' => 'Pesanan Siap',
                        'completed' => 'Selesai',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->dateTime('d M H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('outlet_id')
                    ->relationship('outlet', 'name')
                    ->label('Filter Outlet')
                    ->visible(fn () => auth()->user()?->hasRole('super_admin') || ! auth()->user()?->outlet_id),
            ])
            ->actions([
                Tables\Actions\Action::make('invoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-document-text')
                    ->color('warning')
                    ->url(fn (Order $record) => route('order.invoice', $record->order_code))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
