<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    protected function transformProperty($property)
    {
        $transformed = [
            'id' => $property->id,
            'status' => $property->status,
            'code' => $property->code,
            'image_urls' => $property->image_urls,
            'is_offer' => $property->is_offer,
            'slug' => $property->slug,
            'category' => $property->category ? [
                'id' => $property->category->id,
                'name' => $property->category->name,
                'description' => $property->category->description,
            ] : null,
            'type' => $property->type ? [
                'id' => $property->type->id,
                'name' => $property->type->name,
                'description' => $property->type->description,
            ] : null,
            'price' => $property->price ? [
                'description' => $property->price->description,
                'priceBs' => $property->price->priceBs,
                'priceUSD' => $property->price->priceUSD,
                'pricePerSquareMeterBs' => $property->price->pricePerSquareMeterBs,
            ] : null,
            'location' => $property->location ? [
                'address' => $property->location->address,
                'locationUrl' => $property->location->locationUrl,
                'zone' => $property->location->zone,
            ] : null,
            'feature' => $property->feature ? [
                'floors' => $property->feature->floors,
                'surfaceArea' => $property->feature->surfaceArea,
                'builtArea' => $property->feature->builtArea,
                'front' => $property->feature->front,
                'details' => $property->feature->details,
            ] : null,
            'services' => $property->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'description' => $service->description,
                ];
            }),
        ];

        return $transformed;
    }

    public function index()
    {
        $properties = Property::with(['category', 'type', 'price', 'location', 'feature', 'services'])
            ->where('status', 'available')
            ->get()
            ->map(function ($property) {
                return $this->transformProperty($property);
            });

        return response()->json($properties);
    }

    public function show($slug)
    {
        $property = Property::with(['category', 'type', 'price', 'location', 'feature', 'services'])
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($this->transformProperty($property));
    }
}