<?php

namespace App\Filament\Resources\SubFacilityResource\Pages;

use App\Filament\Resources\SubFacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubFacility extends EditRecord
{
    protected static string $resource = SubFacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 