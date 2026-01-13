<?php

namespace App\Filament\Resources\SejarahSingkatSettingsResource\Pages;

use App\Filament\Resources\SejarahSingkatSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSejarahSingkatSettings extends EditRecord
{
    protected static string $resource = SejarahSingkatSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
