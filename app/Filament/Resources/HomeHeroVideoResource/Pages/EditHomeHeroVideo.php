<?php

namespace App\Filament\Resources\HomeHeroVideoResource\Pages;

use App\Filament\Resources\HomeHeroVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeHeroVideo extends EditRecord
{
    protected static string $resource = HomeHeroVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 