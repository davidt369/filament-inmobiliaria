<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        'code',
        'image_urls',
        'seller_images',
        'is_offer',
        'expiration_date',
        'category_id',
        'type_id',
        'owner_id',
        'price_id',
        'location_id',
        'feature_id'
    ];

    protected $casts = [
        'image_urls' => 'array',
        'seller_images' => 'array',
        'is_offer' => 'boolean',
        'expiration_date' => 'datetime'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'property_services')
            ->withTimestamps();
    }
}
