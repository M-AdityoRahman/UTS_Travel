<?php

namespace App\Http\Controllers;

use App\Models\TravelWishlist;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        return view('travels.index', [
            'travels' => TravelWishlist::latest()->get()
        ]);
    }
}
