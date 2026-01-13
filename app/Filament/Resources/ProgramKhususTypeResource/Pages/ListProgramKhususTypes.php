<?php

namespace App\Filament\Resources\ProgramKhususTypeResource\Pages;

use App\Filament\Resources\ProgramKhususTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramKhususTypes extends ListRecords
{
    protected static string $resource = ProgramKhususTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}


