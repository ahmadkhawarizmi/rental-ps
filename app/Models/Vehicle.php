<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'brand',
        'plate_number',
        'price_per_day',
        'status',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function rentalTransactions(): HasMany
    {
        return $this->hasMany(RentalTransaction::class);
    }
}
