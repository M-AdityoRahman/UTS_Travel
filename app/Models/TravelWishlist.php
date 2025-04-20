<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelWishlist extends Model
{
    use HasFactory;

    // Field yang boleh diisi secara mass-assignment
    protected $fillable = [
        'place_name',
        'location',
        'travel_type',
        'priority_level',
        'estimated_cost',
    ];
}
