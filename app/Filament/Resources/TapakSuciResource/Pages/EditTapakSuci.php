<?php

namespace App\Filament\Resources\TapakSuciResource\Pages;

use App\Filament\Resources\TapakSuciResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTapakSuci extends EditRecord
{
    protected static string $resource = TapakSuciResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 