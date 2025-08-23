<?php

namespace App\Filament\Resources\HisbulWathanContentResource\Pages;

use App\Filament\Resources\HisbulWathanContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHisbulWathanContents extends ListRecords
{
    protected static string $resource = HisbulWathanContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 