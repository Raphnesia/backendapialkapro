<?php

namespace App\Filament\Resources\SubFacilityResource\Pages;

use App\Filament\Resources\SubFacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubFacilities extends ListRecords
{
    protected static string $resource = SubFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 