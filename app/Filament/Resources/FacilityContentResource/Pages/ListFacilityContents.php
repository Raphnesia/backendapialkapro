<?php

namespace App\Filament\Resources\FacilityContentResource\Pages;

use App\Filament\Resources\FacilityContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacilityContents extends ListRecords
{
    protected static string $resource = FacilityContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 