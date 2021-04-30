<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\InstitutionController;
use App\Http\Controllers\Api\V1\PlaceController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\TariffController;

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

Route::group(['middleware' => 'can_auth:api'], function() {
    Route::group(['prefix' => 'institutions'], function () {
        Route::get('/', [InstitutionController::class, 'index']);
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'institutions'], function () {
        Route::post('/', [InstitutionController::class, 'store']);
    });
    Route::group(['prefix' => 'places'], function () {
        Route::get('/', [PlaceController::class, 'all']);
        Route::post('/', [PlaceController::class, 'store']);
        Route::put('/', [PlaceController::class, 'update']);
        Route::delete('/', [PlaceController::class, 'delete']);
    });
    Route::group(['prefix' => 'services'], function () {
        Route::get('/', [ServiceController::class, 'all']);
        Route::post('/', [ServiceController::class, 'store']);
        Route::put('/', [ServiceController::class, 'update']);
        Route::delete('/', [ServiceController::class, 'delete']);
    });
    Route::group(['prefix' => 'tariffs'], function () {
        Route::get('/', [TariffController::class, 'all']);
        Route::post('/', [TariffController::class, 'store']);
        Route::put('/', [TariffController::class, 'update']);
        Route::delete('/', [TariffController::class, 'delete']);
    });
});
