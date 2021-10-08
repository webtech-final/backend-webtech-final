<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PointRateController;
use App\Models\PointRate;
use App\Models\Texture;
use Facade\FlareClient\Api;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('items', \App\Http\Controllers\ItemController::class);
Route::resource('images', \App\Http\Controllers\ImageController::class);
Route::get('/rate/change', [PointRateController::class, 'change'])->name('rate.change');
Route::resource('rate', PointRateController::class);
// Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload'])->name('upload');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

// Route::group([

//     'middleware' => 'web',
//     'prefix' => 'auth'

// ], function () {

//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('logout', [AuthController::class, 'logout']);
//     Route::post('refresh', [AuthController::class, 'refresh']);
//     Route::post('register', [AuthController::class, 'register']);
//     Route::post('me', [AuthController::class, 'me']);
// });
require __DIR__ . '/auth.php';
