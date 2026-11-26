<?php

namespace App\Filament\Admin\Resources\MenuResource\Pages;

use App\Filament\Admin\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenu extends CreateRecord
{
    protected static string $resource = MenuResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! auth()->user()?->hasRole('super_admin') && auth()->user()->outlet_id) {
            $data['outlet_id'] = auth()->user()->outlet_id;
        }

        return $data;
    }
}
