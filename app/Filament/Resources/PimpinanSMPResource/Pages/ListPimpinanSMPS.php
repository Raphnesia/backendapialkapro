<?php

namespace App\Filament\Resources\PimpinanSMPResource\Pages;

use App\Filament\Resources\PimpinanSMPResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPimpinanSMPS extends ListRecords
{
    protected static string $resource = PimpinanSMPResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
