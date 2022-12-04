<?php

use App\Http\Controllers\API\TripController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('trips', [TripController::class, 'getTrips']);
Route::get('trips/{trip}/seats', [TripController::class, 'getTripAvailableSeats']);
Route::post('trips/{trip}/bookings', [TripController::class, 'bookTripSeat'])->middleware('auth:sanctum');
