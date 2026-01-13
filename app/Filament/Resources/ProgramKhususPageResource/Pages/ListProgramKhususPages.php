<?php

namespace App\Filament\Resources\ProgramKhususPageResource\Pages;

use App\Filament\Resources\ProgramKhususPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramKhususPages extends ListRecords
{
    protected static string $resource = ProgramKhususPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}


