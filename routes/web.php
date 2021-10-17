<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\PointRateController;
use App\Http\Controllers\UploadController;
use App\Models\Item;
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
    return redirect()->route('items.index');
});
Route::prefix('items')->group(function () {

    Route::resource('details', ItemDetailController::class);
});
Route::get('items/createBackground', [ItemController::class, 'createBackground'])->name('items.createBackground');
Route::post('items/storeBackground', [ItemController::class, 'storeBackground'])->name('items.storeBackground');
Route::get('item/{type}/{slug}', [ItemController::class, 'showBySlug'])->name('items.slug');
Route::resource('items', \App\Http\Controllers\ItemController::class);
Route::get('/rate/change', [PointRateController::class, 'change'])->name('rate.change');
Route::resource('rate', PointRateController::class);
// Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload'])->name('upload');
Route::post('/uploadBlock', [\App\Http\Controllers\UploadController::class, 'uploadBlock'])->name('items.uploadBlock');
Route::post('/updateBlock', [UploadController::class, 'updateBlock'])->name('upload.updateBlock');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

require __DIR__ . '/auth.php';
