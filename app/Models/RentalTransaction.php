<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalTransaction extends Model
{
    protected $fillable = [
        'transaction_code',
        'customer_id',
        'vehicle_id',
        'rental_date',
        'return_date',
        'actual_return_date',
        'price_per_day',
        'total_days',
        'total_price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'rental_date' => 'date',
            'return_date' => 'date',
            'actual_return_date' => 'date',
            'price_per_day' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
