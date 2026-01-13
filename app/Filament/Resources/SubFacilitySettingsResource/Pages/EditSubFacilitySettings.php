<?php

namespace App\Filament\Resources\SubFacilitySettingsResource\Pages;

use App\Filament\Resources\SubFacilitySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubFacilitySettings extends EditRecord
{
    protected static string $resource = SubFacilitySettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 