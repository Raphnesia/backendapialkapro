<?php

namespace App\Filament\Resources\ProfilSettingsResource\Pages;

use App\Filament\Resources\ProfilSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilSettings extends EditRecord
{
    protected static string $resource = ProfilSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
