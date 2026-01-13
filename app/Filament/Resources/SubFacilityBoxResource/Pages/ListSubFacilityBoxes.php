<?php

namespace App\Filament\Resources\SubFacilityBoxResource\Pages;

use App\Filament\Resources\SubFacilityBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubFacilityBoxes extends ListRecords
{
    protected static string $resource = SubFacilityBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 