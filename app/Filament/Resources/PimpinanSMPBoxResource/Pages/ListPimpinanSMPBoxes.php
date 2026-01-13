<?php

namespace App\Filament\Resources\PimpinanSMPBoxResource\Pages;

use App\Filament\Resources\PimpinanSMPBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPimpinanSMPBoxes extends ListRecords
{
    protected static string $resource = PimpinanSMPBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
