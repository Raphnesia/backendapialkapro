<?php

namespace App\Filament\Resources\FacilityBoxResource\Pages;

use App\Filament\Resources\FacilityBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacilityBoxes extends ListRecords
{
    protected static string $resource = FacilityBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 