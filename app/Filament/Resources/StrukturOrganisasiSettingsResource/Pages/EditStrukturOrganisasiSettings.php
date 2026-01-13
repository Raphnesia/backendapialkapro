<?php

namespace App\Filament\Resources\StrukturOrganisasiSettingsResource\Pages;

use App\Filament\Resources\StrukturOrganisasiSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStrukturOrganisasiSettings extends EditRecord
{
    protected static string $resource = StrukturOrganisasiSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
