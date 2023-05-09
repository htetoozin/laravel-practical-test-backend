<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RegisteredUserController;
use App\Http\Controllers\Api\V1\AuthenticatedController;
use App\Http\Controllers\Api\V1\FormController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('login', [AuthenticatedController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('forms', [FormController::class, 'store']);
    });

});
