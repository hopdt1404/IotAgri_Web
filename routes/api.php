<?php

use App\Http\Controllers\API\AnalyticsDataAPIController;
use App\Http\Controllers\API\LocateAPIController;
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
use App\Http\Controllers\API\PlotAPIController;
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


    // For all User
    Route::get('locate', [LocateAPIController::class, 'index']);
    Route::get('farm_type', [FarmTypeAPIController::class, 'index']);
    Route::resource('plant-state', PlantStateAPIController::class);


    Route::get('farm/getListFarmOfUser', [FarmAPIController::class, 'getListFarmOfUser']);

    Route::get('plant_type', [PlantTypeAPIController::class, 'index']);
    Route::get('soil_type', [SoilTypeAPIController::class, 'index']);



    Route::get('device_type', [DeviceTypeAPIController::class, 'index']);

    Route::post('device', [DeviceAPIController::class, 'store']);
    Route::put('device/{deviceId}', [DeviceAPIController::class, 'update']);

    Route::get('device/getListDeviceSelectOfFarmPlant', [DeviceAPIController::class, 'getListDeviceSelectOfFarmPlant']);
    Route::get('device/getListDeviceSelectOfFarmPlot', [DeviceAPIController::class, 'getListDeviceSelectOfFarmPlot']);
    Route::get('device/getDeviceAssignForPlantFarm', [DeviceAPIController::class, 'getDeviceAssignForPlantFarm']);



    Route::middleware(['admin'])->group(function () {


    });
    Route::post('plant', [PlantAPIController::class, 'store']);
    Route::put('plant/{plant}', [PlantAPIController::class, 'update']);

    Route::resource('plant-state-info', PlantStateInfoAPIController::class);
//    Route::post('plant-state-info', [PlantStateInfoAPIController::class, 'store']);
//    Route::put('plant-state-info/{plant-state-info}', [PlantStateInfoAPIController::class, 'update']);
//    Route::get('plant-state-info/create', [PlantStateInfoAPIController::class, 'create']);
    Route::post('farm', [FarmAPIController::class, 'store']);
    Route::put('farm/{farm}', [FarmAPIController::class, 'update']);
    Route::post('farm/setting', [FarmAPIController::class, 'setting']);
    Route::get('farm/getListFarmSelect', [FarmAPIController::class, 'getListFarmSelect']);
    Route::get('farm/getFarmAgricultureSetting', [FarmAPIController::class, 'getFarmAgricultureSetting']);
    Route::get('plot/getPlotOfFarm', [PlotAPIController::class, 'getPlotOfFarm']);
    Route::get('plot/getListPlotOfFarmSelect', [PlotAPIController::class, 'getListPlotOfFarmSelect']);
    Route::resource('plot', PlotAPIController::class);

    Route::get('device/getDeviceOfFarm', [DeviceAPIController::class, 'getDeviceOfFarm']);
    Route::get('device/getDeviceSettingFarm', [DeviceAPIController::class, 'getDeviceSettingFarm']);

    Route::get('plant/getPlantOfFarm', [PlantAPIController::class, 'getPlantOfFarm']);
    Route::get('plant/getPlantSettingFarm', [PlantAPIController::class, 'getPlantSettingFarm']);
    Route::get('plant/getPlantAssignOfDevice', [PlantAPIController::class, 'getPlantAssignOfDevice']);

    Route::resource('agriculture-plant', AgriculturePlantAPIController::class);
    Route::get('management-agriculture', [AgriculturePlantAPIController::class, 'getPlantAgricultureManagement']);
    Route::put('management-agriculture/savePlantAgriculture/{id}', [AgriculturePlantAPIController::class, 'savePlantAgriculture']);
    Route::get('management-agriculture/detail/{id}', [AgriculturePlantAPIController::class, 'getPlantAgricultureDetail']);
    Route::get('farm', [FarmAPIController::class, 'index']);
    Route::get('farm/{farm}', [FarmAPIController::class, 'show']);

    Route::middleware('user')->group(function () {


    });
    Route::get('device/getListDeviceAdmin', [DeviceAPIController::class, 'getListDeviceAdmin']);
    Route::get('device/getListUserCanOwnerDevice', [DeviceAPIController::class, 'getListUserCanOwnerDevice']);

    Route::get('device', [DeviceAPIController::class, 'index']);
    Route::get('device/{deviceId}', [DeviceAPIController::class, 'show']);
    Route::get('device/getFarmAssignedDevice/{deviceId}', [DeviceAPIController::class, 'getFarmAssignedDevice']);

    Route::get('plant', [PlantAPIController::class, 'index']);
    Route::get('plant/{plant}', [PlantAPIController::class, 'show']);

    Route::get('analytics/getDataAnalytics', [AnalyticsDataAPIController::class, 'getDataAnalytics']);
    Route::get('analytics/analyticDataSevenDayNearest', [AnalyticsDataAPIController::class, 'analyticDataSevenDayNearest']);
});

Route::middleware('guest:sanctum')->group(function () {
    // Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);
});
