<?php

namespace App\Filament\Resources\SchoolActivitySettingsResource\Pages;

use App\Filament\Resources\SchoolActivitySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolActivitySettings extends EditRecord
{
    protected static string $resource = SchoolActivitySettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 