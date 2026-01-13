<?php

namespace App\Filament\Resources\FacilitySettingsResource\Pages;

use App\Filament\Resources\FacilitySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFacilitySettings extends EditRecord
{
    protected static string $resource = FacilitySettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 