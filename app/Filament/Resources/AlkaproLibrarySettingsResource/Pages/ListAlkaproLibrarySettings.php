<?php

namespace App\Filament\Resources\AlkaproLibrarySettingsResource\Pages;

use App\Filament\Resources\AlkaproLibrarySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlkaproLibrarySettings extends ListRecords
{
    protected static string $resource = AlkaproLibrarySettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
