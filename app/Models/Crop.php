<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'crop_name',
        'season',
        'area_planted',
        'area_unit',
        'planting_date',
        'expected_harvest_date',
        'status',
        'notes',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}