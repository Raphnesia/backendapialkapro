<?php

namespace App\Filament\Resources\MarqueeTextResource\Pages;

use App\Filament\Resources\MarqueeTextResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListMarqueeTexts extends ListRecords
{
    protected static string $resource = MarqueeTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Teks Marquee')
                ->icon('heroicon-o-plus'),
        ];
    }
} 