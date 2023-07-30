<?php

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

require __DIR__ . '/auth.php';

Route::get('storage/images/supplier/{filename}', function ($filename) {
    $path = storage_path('app/public/images/supplier/' . $filename);
    return response()->file($path);
});

Route::get('storage/images/category/{filename}', function ($filename) {
    $path = storage_path('app/public/images/category/' . $filename);
    return response()->file($path);
});


// ONLY TO TEST, SHOULD BE REMOVED ON PROD
Route::get('test/{id}', function ($id) {
    $user = Auth::user();

    $category = \App\Models\Category::find($id);

    $categories = $category->suppliers()->with('medias')->where(function ($query) use ($user) {
        $query->where('user_id', null)
            ->orWhere('user_id', $user->id);
    })->get();

    dd($categories);
    //return response()->json($user->suppliers()->get()->load('medias'));
    // test things
});


// ONLY TO TEST, SHOULD BE REMOVED ON PROD
Route::get('test/{media}', function (\App\Models\Media $media) {

    $media->delete();

    //$path = str_replace('storage/', '', $media->path);
//
    //if (Storage::disk('public')->exists($path)) {
    //    Storage::disk('public')->delete($path);
    //}

    // test things
});
