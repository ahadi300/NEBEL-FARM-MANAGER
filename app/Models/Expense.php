<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'category',
        'description',
        'amount',
        'expense_date',
        'payment_method',
        'notes',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
