<?php

namespace App\Filament\Resources\TapakSuciContentResource\Pages;

use App\Filament\Resources\TapakSuciContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTapakSuciContents extends ListRecords
{
    protected static string $resource = TapakSuciContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 