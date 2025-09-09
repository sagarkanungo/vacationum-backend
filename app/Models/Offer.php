<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount_percentage',
        'discount_amount',
        'code',
        'valid_from',
        'valid_to',
        'active',
    ];
}

