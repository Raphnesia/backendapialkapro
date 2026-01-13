<?php

namespace App\Filament\Resources\PimpinanSMPSettingsResource\Pages;

use App\Filament\Resources\PimpinanSMPSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPimpinanSMPSettings extends EditRecord
{
    protected static string $resource = PimpinanSMPSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
