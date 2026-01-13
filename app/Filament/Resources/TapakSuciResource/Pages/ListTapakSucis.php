<?php

namespace App\Filament\Resources\TapakSuciResource\Pages;

use App\Filament\Resources\TapakSuciResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTapakSucis extends ListRecords
{
    protected static string $resource = TapakSuciResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 