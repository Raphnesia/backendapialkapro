<?php

namespace App\Filament\Resources\HisbulWathanSettingsResource\Pages;

use App\Filament\Resources\HisbulWathanSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHisbulWathanSettings extends EditRecord
{
    protected static string $resource = HisbulWathanSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 