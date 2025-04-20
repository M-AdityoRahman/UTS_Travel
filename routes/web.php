<?php

use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('dashboard', function () { 
    return view('dashboard');
})->name('dashboard');

Route::controller(TravelController::class)->prefix('travels')->group(function () {
    Route::get('', 'index')->name('travels'); 
});
