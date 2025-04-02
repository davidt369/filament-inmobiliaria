<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'floors',
        'surfaceArea',
        'builtArea',
        'front',
        'details'
    ];

    public function property(): HasOne
    {
        return $this->hasOne(Property::class);
    }
}
