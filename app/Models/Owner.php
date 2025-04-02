<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fullName',
        'phone',
        'identityCard',
        'address',
        'relativePhone',
        'relativeName',
        'origin',
        'consignor'
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
