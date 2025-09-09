

<?php

use App\Http\Controllers\API\AirlineController;
use App\Http\Controllers\API\AirportController;
use App\Http\Controllers\API\FlightController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;


Route::apiResource('products', ProductController::class);



Route::get('airports', [AirportController::class,'index']);
Route::get('airlines', [AirlineController::class,'index']);
Route::post('flights/search', [FlightController::class,'search']);
Route::get('/offers', [OfferController::class, 'index']);
Route::get('/flights/roundtrip-combined', [FlightController::class, 'roundtripCombined']); // optional combined view
Route::get('/test', function () {
    return response()->json(['message' => 'Hello from API']);
});


