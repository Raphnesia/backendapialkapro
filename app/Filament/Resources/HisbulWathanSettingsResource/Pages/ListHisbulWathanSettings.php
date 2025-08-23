<?php

namespace App\Filament\Resources\HisbulWathanSettingsResource\Pages;

use App\Filament\Resources\HisbulWathanSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHisbulWathanSettings extends ListRecords
{
    protected static string $resource = HisbulWathanSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 