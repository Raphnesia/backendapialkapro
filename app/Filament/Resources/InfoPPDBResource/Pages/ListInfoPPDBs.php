<?php

namespace App\Filament\Resources\InfoPPDBResource\Pages;

use App\Filament\Resources\InfoPPDBResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListInfoPPDBs extends ListRecords
{
    protected static string $resource = InfoPPDBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Program PPDB')
                ->icon('heroicon-o-plus'),
        ];
    }
} 