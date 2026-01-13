<?php

namespace App\Filament\Resources\NavbarItemResource\Pages;

use App\Filament\Resources\NavbarItemResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListNavbarItems extends ListRecords
{
    protected static string $resource = NavbarItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Item Navbar')
                ->icon('heroicon-o-plus'),
        ];
    }
} 