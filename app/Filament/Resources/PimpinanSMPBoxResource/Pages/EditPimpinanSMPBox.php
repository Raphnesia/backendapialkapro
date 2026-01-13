<?php

namespace App\Filament\Resources\PimpinanSMPBoxResource\Pages;

use App\Filament\Resources\PimpinanSMPBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPimpinanSMPBox extends EditRecord
{
    protected static string $resource = PimpinanSMPBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
