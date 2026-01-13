<?php

namespace App\Filament\Resources\IPMResource\Pages;

use App\Filament\Resources\IPMResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIPMS extends ListRecords
{
    protected static string $resource = IPMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
