<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FarmAPIController;
use App\Http\Controllers\API\DeviceAPIController;
use App\Http\Controllers\API\FarmTypeAPIController;
use App\Http\Controllers\API\DeviceTypeAPIController;
use App\Http\Controllers\API\SoilTypeAPIController;
use App\Http\Controllers\API\PlantTypeAPIController;
use App\Http\Controllers\API\PlantAPIController;

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

Route::middleware('auth:sanctum')->group(function () {
     Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
    Route::resource('farm', FarmAPIController::class);
    Route::resource('device', DeviceAPIController::class);
    Route::resource('plant', PlantAPIController::class);
    Route::get('farm_type', [FarmTypeAPIController::class, 'index']);
    Route::get('device_type', [DeviceTypeAPIController::class, 'index']);
    Route::get('plant_type', [PlantTypeAPIController::class, 'index']);
    Route::get('soil_type', [SoilTypeAPIController::class, 'index']);
});

Route::middleware('guest:sanctum')->group(function () {
    // Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);
});
