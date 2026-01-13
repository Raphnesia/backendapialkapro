<?php

namespace App\Filament\Resources\IPMSettingsResource\Pages;

use App\Filament\Resources\IPMSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIPMSettings extends ListRecords
{
    protected static string $resource = IPMSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
