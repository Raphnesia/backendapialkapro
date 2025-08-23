<?php

namespace App\Filament\Resources\TapakSuciContentResource\Pages;

use App\Filament\Resources\TapakSuciContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTapakSuciContent extends EditRecord
{
    protected static string $resource = TapakSuciContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 