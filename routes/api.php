<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MediaController;
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

Route::middleware('auth.api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('subscriptions', SubscriptionController::class);

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}/suppliers', [SupplierController::class, 'index'])->name('categories.suppliers.index');
    Route::post('/categories/{category}/suppliers', [SupplierController::class, 'store'])->name('categories.suppliers.store');
    Route::get('/medias/{media}', [MediaController::class, 'show'])->name('medias.show');
});
