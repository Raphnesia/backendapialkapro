<?php

namespace App\Filament\Resources\StrukturOrganisasiSettingsResource\Pages;

use App\Filament\Resources\StrukturOrganisasiSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStrukturOrganisasiSettings extends ListRecords
{
    protected static string $resource = StrukturOrganisasiSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
