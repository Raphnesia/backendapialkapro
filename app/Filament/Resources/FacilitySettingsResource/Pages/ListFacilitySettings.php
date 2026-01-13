<?php

namespace App\Filament\Resources\FacilitySettingsResource\Pages;

use App\Filament\Resources\FacilitySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacilitySettings extends ListRecords
{
    protected static string $resource = FacilitySettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 