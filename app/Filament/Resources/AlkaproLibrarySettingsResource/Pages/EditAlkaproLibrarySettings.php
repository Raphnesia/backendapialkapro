<?php

namespace App\Filament\Resources\AlkaproLibrarySettingsResource\Pages;

use App\Filament\Resources\AlkaproLibrarySettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlkaproLibrarySettings extends EditRecord
{
    protected static string $resource = AlkaproLibrarySettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure arrays are properly formatted for Filament forms
        if (isset($data['collection_features']) && is_string($data['collection_features'])) {
            $data['collection_features'] = json_decode($data['collection_features'], true) ?? [];
        }

        if (isset($data['facility_features']) && is_string($data['facility_features'])) {
            $data['facility_features'] = json_decode($data['facility_features'], true) ?? [];
        }

        if (isset($data['additional_services']) && is_string($data['additional_services'])) {
            $data['additional_services'] = json_decode($data['additional_services'], true) ?? [];
        }

        if (isset($data['library_gallery']) && is_string($data['library_gallery'])) {
            $data['library_gallery'] = json_decode($data['library_gallery'], true) ?? [];
        }

        if (isset($data['library_pamphlets']) && is_string($data['library_pamphlets'])) {
            $data['library_pamphlets'] = json_decode($data['library_pamphlets'], true) ?? [];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Set default values if arrays are empty
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
