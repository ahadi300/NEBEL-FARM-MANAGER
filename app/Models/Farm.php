<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_name',
        'owner_name',
        'location',
        'size',
        'size_unit',
        'phone',
        'notes',
    ];

    public function crops()
    {
        return $this->hasMany(Crop::class);
    }

    public function livestock()
{
    return $this->hasMany(Livestock::class);
}
}