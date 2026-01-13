<?php

namespace App\Filament\Resources\HisbulWathanResource\Pages;

use App\Filament\Resources\HisbulWathanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHisbulWathans extends ListRecords
{
    protected static string $resource = HisbulWathanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 