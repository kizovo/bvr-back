<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\InitController;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\UserController;

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

Route::group(['namespace' => 'Api\V1'], function(){
    // Frontend Auth
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    // Admin Auth
    Route::group(['prefix' => config('app.admin_route')], function(){
        Route::post('login', [AuthController::class, 'adminLogin']);
        Route::post('register', [AuthController::class, 'adminRegister']);
    });

    // User Should Authenticated
    Route::get('profile', [UserController::class, 'profile'])->middleware(['auth:api', 'cacheResponse:300']);
    Route::post('test-mail', [TestController::class, 'sendMail'])->middleware(['auth:api-admin']);
    Route::get('test-setting', [TestController::class, 'settings'])->middleware(['auth:api-admin', 'cacheResponse:300']);
    // Admin Should Authenticated
    Route::get('dashboard', [TestController::class, 'dashboard'])->middleware(['auth:api-admin', 'cacheResponse:300']);

    // No Authenticated
    Route::get('/', [InitController::class, 'index'])->middleware('cacheResponse:300');
});
