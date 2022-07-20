<?php

use App\Http\Controllers\HistoricPriceController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/crypto/last-price-bitcoin', [HistoricPriceController::class, 'lastPriceBitcoin']);
Route::get('/crypto/get-price-datetime-bitcoin', [HistoricPriceController::class, 'priceDatetimeBitcoin']);

Route::get('/crypto/historic', [HistoricPriceController::class, 'show']);
Route::get('/crypto/last-price-coin', [HistoricPriceController::class, 'lastPriceCoin']);
Route::get('/crypto/price-datetime-coin', [HistoricPriceController::class, 'priceDatetimeCoin']);
