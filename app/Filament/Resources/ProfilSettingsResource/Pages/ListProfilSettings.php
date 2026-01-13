<?php

namespace App\Filament\Resources\ProfilSettingsResource\Pages;

use App\Filament\Resources\ProfilSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfilSettings extends ListRecords
{
    protected static string $resource = ProfilSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
