<?php

namespace App\Filament\Resources\SejarahSingkatSettingsResource\Pages;

use App\Filament\Resources\SejarahSingkatSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSejarahSingkatSettings extends ListRecords
{
    protected static string $resource = SejarahSingkatSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
