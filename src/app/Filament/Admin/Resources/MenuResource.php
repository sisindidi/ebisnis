<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Menus';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['outlet:id,name']);

        $user = auth()->user();
        if (! $user?->isSuperAdmin() && $user?->outlet_id) {
            $query->where('outlet_id', $user->outlet_id);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('outlet_id')
                    ->relationship('outlet', 'name')
                    ->label('Outlet')
                    ->default(fn () => auth()->user()?->outlet_id)
                    ->disabled(fn () => ! auth()->user()?->hasRole('super_admin') && (bool) auth()->user()?->outlet_id)
                    ->dehydrated()
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Menu')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'makanan' => 'Makanan',
                        'minuman' => 'Minuman',
                        'cemilan' => 'Cemilan',
                    ])
                    ->default('makanan')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\Toggle::make('is_available')
                    ->label('Status Ketersediaan (Tersedia / Habis)')
                    ->helperText('Aktifkan jika menu tersedia. Matikan jika menu sedang HABIS (Stok Habis).')
                    ->default(true),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto Makanan/Minuman')
                    ->image()
                    ->disk('public')
                    ->directory('menus')
                    ->visibility('public')
                    ->helperText('Kosongkan jika ingin tetap memakai foto default di katalog.')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->size(64)
                    ->getStateUsing(fn (Menu $record): string => Menu::resolveImageUrl($record->image, $record->name))
                    ->extraImgAttributes(['class' => 'rounded-xl object-cover border border-[#DCEAF7] shadow-xs', 'loading' => 'lazy', 'decoding' => 'async'])
                    ->defaultImageUrl(asset('images/kampus-esaunggul.jpg')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Menu')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'makanan' => 'warning',
                        'minuman' => 'info',
                        'cemilan' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state ?? 'makanan'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('outlet.name')
                    ->label('Outlet')
                    ->badge()
                    ->color('gray')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn ($state) => 'Rp' . number_format((float) $state, 0, ',', '.'))
                    ->weight('bold')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_available')
                    ->label('Ketersediaan')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->tooltip('Ubah status ketersediaan secara langsung'),

                Tables\Columns\TextColumn::make('is_available')
                    ->label('Status')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Tersedia' : 'Habis')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_available')
                    ->label('Status Ketersediaan')
                    ->options([
                        '1' => 'Tersedia',
                        '0' => 'Habis',
                    ]),

                Tables\Filters\SelectFilter::make('outlet_id')
                    ->relationship('outlet', 'name')
                    ->label('Filter Outlet')
                    ->visible(fn () => auth()->user()?->hasRole('super_admin') || ! auth()->user()?->outlet_id),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options([
                        'makanan' => 'Makanan',
                        'minuman' => 'Minuman',
                        'cemilan' => 'Cemilan',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('toggle_habis')
                    ->label(fn (Menu $record): string => $record->is_available ? 'Set Habis' : 'Set Tersedia')
                    ->icon(fn (Menu $record): string => $record->is_available ? 'heroicon-m-x-circle' : 'heroicon-m-check-circle')
                    ->color(fn (Menu $record): string => $record->is_available ? 'danger' : 'success')
                    ->tooltip(fn (Menu $record): string => $record->is_available ? 'Tandai menu ini HABIS' : 'Jadikan menu TERSEDIA')
                    ->action(function (Menu $record): void {
                        $record->update(['is_available' => ! $record->is_available]);
                        \Filament\Notifications\Notification::make()
                            ->title($record->is_available ? "Menu '{$record->name}' kini TERSEDIA" : "Menu '{$record->name}' telah ditandai HABIS")
                            ->success()
                            ->send();
                    }),
                Tables\Actions\EditAction::make()
                    ->color('info'),
                Tables\Actions\DeleteAction::make()
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_as_habis')
                        ->label('Tandai Habis')
                        ->icon('heroicon-m-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_available' => false])),
                    Tables\Actions\BulkAction::make('mark_as_available')
                        ->label('Tandai Tersedia')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_available' => true])),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
