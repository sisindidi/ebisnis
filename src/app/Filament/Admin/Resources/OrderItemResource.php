<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderItemResource\Pages;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    // Label navigasi di sidebar admin
    protected static ?string $navigationLabel = 'Detail Pesanan Items';

    protected static ?int $navigationSort = 3;
    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['order:id,order_code,outlet_id', 'menu:id,name']);

        $user = auth()->user();
        if (! $user?->isSuperAdmin() && $user?->outlet_id) {
            $query->whereIn('order_id', \App\Models\Order::where('outlet_id', $user->outlet_id)->select('id'));
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')
                    ->label('Nama Pemesan')
                    ->required(),

                Forms\Components\Select::make('order_id')
                    ->relationship('order', 'order_code')
                    ->label('Kode Pesanan')
                    ->required(),

                Forms\Components\Select::make('menu_id')
                    ->relationship('menu', 'name', modifyQueryUsing: function (Builder $query) {
                        if (! auth()->user()?->hasRole('super_admin') && auth()->user()?->outlet_id) {
                            $query->where('outlet_id', auth()->user()->outlet_id);
                        }
                    })
                    ->label('Menu')
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga Satuan')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.order_code')
                    ->label('Kode Order')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pemesan (Split Bill)')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('menu.name')
                    ->label('Menu')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Qty')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga Satuan')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M H:i')
                    ->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->defaultPaginationPageOption(10)
            ->filters([
                Tables\Filters\SelectFilter::make('menu_id')
                    ->relationship('menu', 'name', modifyQueryUsing: function (Builder $query) {
                        if (! auth()->user()?->hasRole('super_admin') && auth()->user()?->outlet_id) {
                            $query->where('outlet_id', auth()->user()->outlet_id);
                        }
                    })
                    ->label('Filter Menu'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
