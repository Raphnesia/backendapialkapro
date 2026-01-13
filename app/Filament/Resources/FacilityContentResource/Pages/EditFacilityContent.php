<?php

namespace App\Filament\Resources\FacilityContentResource\Pages;

use App\Filament\Resources\FacilityContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFacilityContent extends EditRecord
{
    protected static string $resource = FacilityContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 