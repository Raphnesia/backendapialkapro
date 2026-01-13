<?php

namespace App\Filament\Resources\EkstrakurikulerSettingsResource\Pages;

use App\Filament\Resources\EkstrakurikulerSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEkstrakurikulerSettings extends EditRecord
{
    protected static string $resource = EkstrakurikulerSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
