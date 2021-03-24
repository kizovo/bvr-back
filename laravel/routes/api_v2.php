<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\InitController;

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

Route::group(['namespace' => 'Api\V2'], function(){
    Route::get('init', [InitController::class, 'index']);
});
