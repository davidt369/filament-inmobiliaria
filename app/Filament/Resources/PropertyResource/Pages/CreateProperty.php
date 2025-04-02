<?php

namespace App\Filament\Resources\PropertyResource\Pages;

use App\Filament\Resources\PropertyResource;
use App\Models\Price;
use App\Models\Location;
use App\Models\Feature;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProperty extends CreateRecord
{
    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Crear el registro de precio
        $price = Price::create([
            'description' => $data['price']['description'],
            'priceBs' => floatval($data['price']['priceBs']),
            'priceUSD' => floatval($data['price']['priceUSD']),
            'pricePerSquareMeterBs' => floatval($data['price']['pricePerSquareMeterBs']),
            'exchangeRate' => intval($data['price']['exchangeRate']),
            'priceOwnerBs' => floatval($data['price']['priceOwnerBs']),
            'priceOwnerUSD' => floatval($data['price']['priceOwnerUSD'])
        ]);

        // Crear el registro de ubicación
        $location = Location::create([
            'address' => $data['location']['address'],
            'locationUrl' => $data['location']['locationUrl'],
            'zone' => $data['location']['zone'],
            'seller_location' => $data['location']['seller_location'],
        ]);

        // Crear el registro de características
        $feature = Feature::create([
            'floors' => intval($data['feature']['floors']),
            'surfaceArea' => floatval($data['feature']['surfaceArea']),
            'builtArea' => floatval($data['feature']['builtArea']),
            'front' => floatval($data['feature']['front']),
            'details' => $data['feature']['details']
        ]);

        // Asignar los IDs a la propiedad
        $data['price_id'] = $price->id;
        $data['location_id'] = $location->id;
        $data['feature_id'] = $feature->id;

        // Eliminar los datos ya procesados
        unset($data['price'], $data['location'], $data['feature']);

        return $data;
    }
}
