<?php

use App\Http\Controllers\Apis\LoginController;
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

    Route::post('send-otp', [LoginController::class, 'sendOTP']);

    Route::post('verify-user', [LoginController::class, 'verifyUser']);
    Route::post("login", [LoginController::class, "login"]);
    Route::post("register", [LoginController::class, "register"]);
    Route::post('forgot-password', [LoginController::class, 'forgotPassword']);
});
