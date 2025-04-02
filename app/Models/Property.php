<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            $property->slug = $property->generateSlug();
        });

        static::updating(function ($property) {
            $property->slug = $property->generateSlug();
        });
    }

    protected function generateSlug(): string
    {
        $type = $this->type()->first();
        $category = $this->category()->first();
        $price = $this->price()->first();
        
        $parts = [
            $type?->name ?? '',
            $this->status ?? '',
            $category?->name ?? '',
            $price?->priceUSD ? '$' . number_format($price->priceUSD, 0) : ''
        ];

        $baseSlug = Str::slug(implode(' ', array_filter($parts)));
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

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
