<?php

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
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
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';

Route::get('storage/images/category/{filename}', function ($filename) {
    $path = storage_path('app/public/images/category/' . $filename);
    return response()->file($path);
});


// ONLY TO TEST, SHOULD BE REMOVED ON PROD
Route::get('test', function () {
    $user = Auth::user();

    $subscriptions = new Subscription();
    $subscriptions = $subscriptions->with(['category', 'category.medias', 'supplier', 'supplier.medias'])->where('user_id', $user->id)->get();

    $service = new \App\Service\SubscriptionService();
    $service->mostExpensiveCategory($subscriptions);

    // test things
});
