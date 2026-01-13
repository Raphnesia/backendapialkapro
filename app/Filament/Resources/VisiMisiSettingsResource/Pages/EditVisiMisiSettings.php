<?php

namespace App\Filament\Resources\VisiMisiSettingsResource\Pages;

use App\Filament\Resources\VisiMisiSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisiMisiSettings extends EditRecord
{
    protected static string $resource = VisiMisiSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
