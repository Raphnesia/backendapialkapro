<?php

namespace App\Filament\Resources\SejarahSingkatResource\Pages;

use App\Filament\Resources\SejarahSingkatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSejarahSingkats extends ListRecords
{
    protected static string $resource = SejarahSingkatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
