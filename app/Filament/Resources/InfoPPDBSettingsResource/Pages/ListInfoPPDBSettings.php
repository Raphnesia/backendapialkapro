<?php

namespace App\Filament\Resources\InfoPPDBSettingsResource\Pages;

use App\Filament\Resources\InfoPPDBSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfoPPDBSettings extends ListRecords
{
    protected static string $resource = InfoPPDBSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
