<?php

namespace App\Filament\Resources\AlkaproLibrarySettingsResource\Pages;

use App\Filament\Resources\AlkaproLibrarySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAlkaproLibrarySettings extends CreateRecord
{
    protected static string $resource = AlkaproLibrarySettingsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set default values if not provided
        if (empty($data['collection_features'])) {
            $data['collection_features'] = \App\Models\AlkaproLibrarySettings::getDefaultCollectionFeatures();
        }

        if (empty($data['facility_features'])) {
            $data['facility_features'] = \App\Models\AlkaproLibrarySettings::getDefaultFacilityFeatures();
        }

        if (empty($data['additional_services'])) {
            $data['additional_services'] = \App\Models\AlkaproLibrarySettings::getDefaultAdditionalServices();
        }

        return $data;
    }
}
