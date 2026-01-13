<?php

namespace App\Filament\Resources\FacilityPhotoResource\Pages;

use App\Filament\Resources\FacilityPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFacilityPhoto extends EditRecord
{
    protected static string $resource = FacilityPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 