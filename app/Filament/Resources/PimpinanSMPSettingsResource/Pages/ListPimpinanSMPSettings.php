<?php

namespace App\Filament\Resources\PimpinanSMPSettingsResource\Pages;

use App\Filament\Resources\PimpinanSMPSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPimpinanSMPSettings extends ListRecords
{
    protected static string $resource = PimpinanSMPSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
