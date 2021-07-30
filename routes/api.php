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
use App\Http\Controllers\API\PlantStateAPIController;
use App\Http\Controllers\API\PlantStateInfoAPIController;
use App\Http\Controllers\API\AgriculturePlantAPIController;

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

    Route::middleware(['admin'])->group(function () {
        Route::post('plant', [PlantAPIController::class, 'store']);
        Route::put('plant/{plant}', [PlantAPIController::class, 'update']);

        Route::post('plant-state-info', [PlantStateInfoAPIController::class, 'store']);
        Route::put('plant-state-info/{plant-state-info}', [PlantStateInfoAPIController::class, 'update']);
//        Route::resource('device', DeviceAPIController::class);
        Route::get('device_type', [DeviceTypeAPIController::class, 'index']);
    });

    Route::middleware('user')->group(function () {
        Route::get('farm', [FarmAPIController::class, 'index']);
        Route::post('farm', [FarmAPIController::class, 'store']);
        Route::put('farm/{farm}', [FarmAPIController::class, 'update']);
        Route::post('farm/setting', [FarmAPIController::class, 'setting']);
        Route::get('farm/getFarmAgricultureSetting', [FarmAPIController::class, 'getFarmAgricultureSetting']);
        Route::get('farm/{farm}', [FarmAPIController::class, 'show']);

        Route::get('device/getDeviceOfFarm', [DeviceAPIController::class, 'getDeviceOfFarm']);
        Route::get('device/getDeviceSettingFarm', [DeviceAPIController::class, 'getDeviceSettingFarm']);

        Route::get('plant/getPlantOfFarm', [PlantAPIController::class, 'getPlantOfFarm']);
        Route::get('plant/getPlantSettingFarm', [PlantAPIController::class, 'getPlantSettingFarm']);

        Route::resource('agriculture-plant', AgriculturePlantAPIController::class);
        Route::get('management-agriculture', [AgriculturePlantAPIController::class, 'getPlantAgricultureManagement']);
        Route::get('management-agriculture/detail/{id}', [AgriculturePlantAPIController::class, 'getPlantAgricultureDetail']);
    });

    // For all User
    Route::get('farm_type', [FarmTypeAPIController::class, 'index']);
    Route::resource('plant-state', PlantStateAPIController::class);

    Route::get('plant', [PlantAPIController::class, 'index']);
    Route::get('plant/{plant}', [PlantAPIController::class, 'show']);
    Route::get('plant_type', [PlantTypeAPIController::class, 'index']);
    Route::get('soil_type', [SoilTypeAPIController::class, 'index']);
    Route::get('plant-state-info/create', [PlantStateInfoAPIController::class, 'create']);

// Todo:     Route::get('location')

});

Route::middleware('guest:sanctum')->group(function () {
    // Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);
});
