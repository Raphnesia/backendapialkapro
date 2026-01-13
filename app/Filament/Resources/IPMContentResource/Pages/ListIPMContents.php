<?php

namespace App\Filament\Resources\IPMContentResource\Pages;

use App\Filament\Resources\IPMContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIPMContents extends ListRecords
{
    protected static string $resource = IPMContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
