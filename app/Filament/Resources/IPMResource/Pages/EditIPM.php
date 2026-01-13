<?php

namespace App\Filament\Resources\IPMResource\Pages;

use App\Filament\Resources\IPMResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIPM extends EditRecord
{
    protected static string $resource = IPMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
