<?php

namespace App\Filament\Resources\IPMSettingsResource\Pages;

use App\Filament\Resources\IPMSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIPMSettings extends EditRecord
{
    protected static string $resource = IPMSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
