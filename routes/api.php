<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;

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

Route::post("register",[AuthController::class,'Register']);
Route::post("login",[AuthController::class,'Login']);

//Protected route
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('logout',[AuthController::class,'Logout']);

    //Drivers
    // Route::get('drivers',[DriverController::class,'index']);
    // Route::get('drivers/{id}',[DriverController::class,'show']);
    // Route::put('drivers/{id}',[DriverController::class,'update']);
    // Route::post('drivers',[DriverController::class,'insert']);
    // Route::delete('drivers/{id}',[DriverController::class,'destroy']);
    // Route::post('drivers/search',[DriverController::class,'search']);

    Route::controller(DriverController::class)->group(function(){
        Route::get('drivers','index');
        Route::get('drivers/{id}','show');
        Route::put('drivers/{id}','update');
        Route::post('drivers','insert');
        Route::delete('drivers/{id}','destroy');
        Route::post('drivers/search','search');

    });

    //Vehicles
    Route::controller(DriverController::class)->group(function(){
        Route::get('vehicles','index');
        Route::get('vehicles/{id}','show');
        Route::put('vehicles/{id}','update');
        Route::post('vehicles','insert');
        Route::delete('vehicles/{id}','destroy');
        Route::post('vehicles/search','search');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
