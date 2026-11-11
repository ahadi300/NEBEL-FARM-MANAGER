<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'animal_type',
        'breed',
        'quantity',
        'purchase_date',
        'purchase_cost',
        'health_status',
        'notes',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}