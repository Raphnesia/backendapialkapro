<?php

namespace App\Filament\Resources\VisiMisiSettingsResource\Pages;

use App\Filament\Resources\VisiMisiSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisiMisiSettings extends ListRecords
{
    protected static string $resource = VisiMisiSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
