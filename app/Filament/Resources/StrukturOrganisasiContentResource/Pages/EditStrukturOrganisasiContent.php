<?php

namespace App\Filament\Resources\StrukturOrganisasiContentResource\Pages;

use App\Filament\Resources\StrukturOrganisasiContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStrukturOrganisasiContent extends EditRecord
{
    protected static string $resource = StrukturOrganisasiContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
