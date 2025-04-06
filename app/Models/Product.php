<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'images',
        'quantity',
        'quantity_type',
        'price',
        'type',
        'status',
        'default',
        'rating',
    ];

    protected $casts = [
        'images' => 'array',
        'default' => 'boolean',
        'rating' => 'float',
        'price' => 'decimal:2',
    ];
}
