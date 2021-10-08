<?php

use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('playHistories/singleplayer/{id}', [\App\Http\Controllers\Api\PlayHistoryController::class, 'single_log']);
Route::get('playHistories/versusplayer/{id}', [\App\Http\Controllers\Api\PlayHistoryController::class, 'versus_log']);
Route::get('playHistories/single', [\App\Http\Controllers\Api\PlayHistoryController::class, 'single_index']);
Route::get('playHistories/single/top10', [\App\Http\Controllers\Api\PlayHistoryController::class, 'top10_single_index']);
Route::get('playHistories/versus', [\App\Http\Controllers\Api\PlayHistoryController::class, 'versus_index']);
Route::get('playHistories/versus/top10', [\App\Http\Controllers\Api\PlayHistoryController::class, 'top10_versus_index']);
Route::apiResource('playHistories', \App\Http\Controllers\Api\PlayHistoryController::class);

Route::get('pointHistories/{id}', [\App\Http\Controllers\Api\PointHistoryController::class, 'point_log']);
Route::get('pointHistories/use', [\App\Http\Controllers\Api\PointHistoryController::class, 'use_index']);
Route::get('pointHistories/get', [\App\Http\Controllers\Api\PointHistoryController::class, 'get_index']);
Route::apiResource('pointHistories', \App\Http\Controllers\Api\PointHistoryController::class);


Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload'])->name('upload');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('me', [AuthController::class, 'me']);
    Route::put('getPoint/{id}', [AuthController::class, 'getPoint']);
});
Route::get('pointRate/last', [\App\Http\Controllers\Api\PointRateController::class, 'lastRate']);
Route::apiResource('pointRates', \App\Http\Controllers\Api\PointRateController::class);

Route::get('items/block/inventory/{id}', [\App\Http\Controllers\Api\ItemController::class, 'inventory_block']);
Route::get('items/background/inventory/{id}', [\App\Http\Controllers\Api\ItemController::class, 'inventory_background']);
Route::get('items/block/shop/{id}', [\App\Http\Controllers\Api\ItemController::class, 'shop_block']);
Route::get('items/background/shop/{id}', [\App\Http\Controllers\Api\ItemController::class, 'shop_background']);
Route::apiResource('items', \App\Http\Controllers\Api\ItemController::class);
