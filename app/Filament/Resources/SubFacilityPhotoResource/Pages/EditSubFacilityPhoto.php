<?php

namespace App\Filament\Resources\SubFacilityPhotoResource\Pages;

use App\Filament\Resources\SubFacilityPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubFacilityPhoto extends EditRecord
{
    protected static string $resource = SubFacilityPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 