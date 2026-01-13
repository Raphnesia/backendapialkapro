<?php

namespace App\Filament\Resources\SejarahSingkatResource\Pages;

use App\Filament\Resources\SejarahSingkatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSejarahSingkat extends EditRecord
{
    protected static string $resource = SejarahSingkatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
