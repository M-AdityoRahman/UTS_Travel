<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model untuk tabel travel_wishlists
class TravelWishlist extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mendukung factory saat testing atau seeding

    // Daftar kolom yang diizinkan untuk diisi secara mass-assignment (mass assignment protection)
    protected $fillable = [
        'place_name',       // Nama tempat yang ingin dikunjungi
        'location',         // Lokasi tempat tersebut
        'travel_type',      // Jenis perjalanan (misal: wisata alam, kota, budaya, dll.)
        'priority_level',   // Level prioritas (1 - 5)
        'estimated_cost',   // Perkiraan biaya perjalanan
    ];
}
