<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\SupplierController as UserSupplierController;


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

    Route::get('/subscriptions/datas', [SubscriptionController::class, 'datas'])->name('subscriptions.datas');
    Route::resource('/subscriptions', SubscriptionController::class);

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}/suppliers', [SupplierController::class, 'index'])->name('categories.suppliers.index');
    Route::post('/categories/{category}/suppliers', [SupplierController::class, 'store'])->name('categories.suppliers.store');
    Route::get('/medias/{media}', [MediaController::class, 'show'])->name('medias.show');

    // For User
    Route::middleware(\App\Http\Middleware\IsUserConnected::class)->group(function () {
        Route::get('/users/{user}/categories', [UserCategoryController::class, 'index'])->name('users.categories.index');
        Route::get('/users/{user}/categories/{category}', [UserCategoryController::class, 'show'])->name('users.categories.show');
        Route::delete('/users/{user}/categories/{category}', [UserCategoryController::class, 'destroy'])->name('users.categories.destroy');

        Route::get('/users/{user}/suppliers', [UserSupplierController::class, 'index'])->name('users.suppliers.index');
        Route::get('/users/{user}/suppliers/{supplier}', [UserSupplierController::class, 'show'])->name('users.suppliers.show');
        Route::delete('/users/{user}/suppliers/{supplier}', [UserSupplierController::class, 'destroy'])->name('users.suppliers.destroy');
    });
});
