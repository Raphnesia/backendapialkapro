<?php

namespace App\Filament\Resources\FooterItemResource\Pages;

use App\Filament\Resources\FooterItemResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListFooterItems extends ListRecords
{
    protected static string $resource = FooterItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Item Footer')
                ->icon('heroicon-o-plus'),
        ];
    }
} 