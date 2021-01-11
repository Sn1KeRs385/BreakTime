<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\InstitutionController;

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

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'institutions'], function () {
        Route::post('/', [InstitutionController::class, 'store']);
    });
});