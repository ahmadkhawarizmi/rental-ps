<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'customer_code',
        'name',
        'phone',
        'address',
        'identity_number',
    ];

    public function rentalTransactions(): HasMany
    {
        return $this->hasMany(RentalTransaction::class);
    }
}