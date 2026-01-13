<?php

namespace App\Filament\Resources\HomeHeroVideoResource\Pages;

use App\Filament\Resources\HomeHeroVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeHeroVideos extends ListRecords
{
    protected static string $resource = HomeHeroVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 