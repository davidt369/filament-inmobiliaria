<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use App\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProperty extends EditRecord
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $property = $this->record;

        // Cargar los datos relacionados
        $data['price'] = $property->price->toArray();
        $data['location'] = $property->location->toArray();
        $data['feature'] = $property->feature->toArray();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $property = $this->record;

        // Actualizar el registro de precio
        $property->price->update([
            'description' => $data['price']['description'],
            'priceBs' => floatval($data['price']['priceBs']),
            'priceUSD' => floatval($data['price']['priceUSD']),
            'pricePerSquareMeterBs' => floatval($data['price']['pricePerSquareMeterBs']),
            'exchangeRate' => intval($data['price']['exchangeRate']),
            'priceOwnerBs' => floatval($data['price']['priceOwnerBs']),
            'priceOwnerUSD' => floatval($data['price']['priceOwnerUSD'])
        ]);

        // Actualizar el registro de ubicación
        $property->location->update([
            'address' => $data['location']['address'],
            'locationUrl' => $data['location']['locationUrl'],
            'zone' => $data['location']['zone'],
            'seller_location' => $data['location']['seller_location'],
        ]);

        // Actualizar el registro de características
        $property->feature->update([
            'floors' => intval($data['feature']['floors']),
            'surfaceArea' => floatval($data['feature']['surfaceArea']),
            'builtArea' => floatval($data['feature']['builtArea']),
            'front' => floatval($data['feature']['front']),
            'details' => $data['feature']['details']
        ]);

        // Eliminar los datos ya procesados
        unset($data['price'], $data['location'], $data['feature']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
