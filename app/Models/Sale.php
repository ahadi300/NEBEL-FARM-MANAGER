<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'product_type',
        'product_name',
        'quantity',
        'unit',
        'unit_price',
        'total_amount',
        'buyer_name',
        'buyer_phone',
        'sale_date',
        'notes',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
