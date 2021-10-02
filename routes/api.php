<?php

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

Route::get('playHistories/single', [\App\Http\Controllers\Api\PlayHistoryController::class, 'single_index']);
Route::get('playHistories/single/top10', [\App\Http\Controllers\Api\PlayHistoryController::class, 'top10_single_index']);
Route::get('playHistories/versus', [\App\Http\Controllers\Api\PlayHistoryController::class, 'versus_index']);
Route::get('playHistories/versus/top10', [\App\Http\Controllers\Api\PlayHistoryController::class, 'top10_versus_index']);
Route::apiResource('playHistories', \App\Http\Controllers\Api\PlayHistoryController::class);

Route::get('pointHistories/use', [\App\Http\Controllers\Api\PointHistoryController::class, 'use_index']);
Route::get('pointHistories/get', [\App\Http\Controllers\Api\PointHistoryController::class, 'get_index']);
Route::apiResource('pointHistories', \App\Http\Controllers\Api\PointHistoryController::class);


Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload'])->name('upload');
