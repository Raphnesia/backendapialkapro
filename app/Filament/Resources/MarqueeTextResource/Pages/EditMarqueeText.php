<?php

namespace App\Filament\Resources\MarqueeTextResource\Pages;

use App\Filament\Resources\MarqueeTextResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarqueeText extends EditRecord
{
    protected static string $resource = MarqueeTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 