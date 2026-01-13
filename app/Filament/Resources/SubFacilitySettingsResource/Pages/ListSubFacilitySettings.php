<?php

namespace App\Filament\Resources\SubFacilitySettingsResource\Pages;

use App\Filament\Resources\SubFacilitySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubFacilitySettings extends ListRecords
{
    protected static string $resource = SubFacilitySettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 