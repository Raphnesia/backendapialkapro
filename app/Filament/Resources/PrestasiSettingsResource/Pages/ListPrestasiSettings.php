<?php

namespace App\Filament\Resources\PrestasiSettingsResource\Pages;

use App\Filament\Resources\PrestasiSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrestasiSettings extends ListRecords
{
    protected static string $resource = PrestasiSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 