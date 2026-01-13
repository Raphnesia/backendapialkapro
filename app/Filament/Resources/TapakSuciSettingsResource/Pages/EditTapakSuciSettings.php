<?php

namespace App\Filament\Resources\TapakSuciSettingsResource\Pages;

use App\Filament\Resources\TapakSuciSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTapakSuciSettings extends EditRecord
{
    protected static string $resource = TapakSuciSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 