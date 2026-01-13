<?php

namespace App\Filament\Resources\InfoPPDBResource\Pages;

use App\Filament\Resources\InfoPPDBResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfoPPDB extends EditRecord
{
    protected static string $resource = InfoPPDBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 