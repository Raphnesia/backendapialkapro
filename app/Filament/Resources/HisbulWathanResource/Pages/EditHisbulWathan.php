<?php

namespace App\Filament\Resources\HisbulWathanResource\Pages;

use App\Filament\Resources\HisbulWathanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHisbulWathan extends EditRecord
{
    protected static string $resource = HisbulWathanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 