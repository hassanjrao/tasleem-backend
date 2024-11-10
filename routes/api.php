<?php

use App\Http\Controllers\Apis\LoginController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ServiceController;
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
Route::prefix("v1")->group(function () {

    Route::post('verify-user', [LoginController::class, 'verifyUser']);
    Route::post("register", [LoginController::class, "register"]);
    Route::post("login", [LoginController::class, "login"]);


    Route::post('forgot-password', [LoginController::class, 'forgotPassword']);


    Route::middleware(["auth:sanctum"])->group(function () {

        Route::prefix('services')->group(function () {
            Route::get('/', [ServiceController::class, 'getAllServices']);
            Route::post('create', [ServiceController::class, 'create']);
            Route::post('update', [ServiceController::class, 'update']);
            Route::post('delete', [ServiceController::class, 'delete']);
        });

        Route::prefix('plans')->group(function () {
            Route::get('/', [PlanController::class, 'getAllPlans']);
        });

    });
});
