<?php

namespace App\Filament\Admin\Resources\MenuResource\Pages;

use App\Filament\Admin\Resources\MenuResource;
use App\Filament\Admin\Widgets\MenuStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    public function getTitle(): string
    {
        return 'Manajemen Menu';
    }

    public function getSubheading(): ?string
    {
        return 'Kelola daftar makanan dan minuman yang tersedia di Esa Corner';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MenuStatsOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Menu')
                ->icon('heroicon-m-plus')
                ->color('warning'),
        ];
    }
}
