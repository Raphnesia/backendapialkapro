<?php

namespace App\Filament\Resources\InfoPPDBSettingsResource\Pages;

use App\Filament\Resources\InfoPPDBSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfoPPDBSettings extends EditRecord
{
    protected static string $resource = InfoPPDBSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
