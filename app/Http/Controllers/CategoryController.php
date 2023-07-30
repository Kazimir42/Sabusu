<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        return response()->json(Category::with('medias')->where('user_id', '=', null)->orWhere('user_id', '=', $user->id)->get());
    }

    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        $category = Category::create([
            'title' => $request->title,
            'user_id' => $user->id,
        ]);
        $category->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            Storage::disk('public')->putFileAs('images/category/', $image, $imageName);

            $media = Media::create([
                'title' => $imageName,
                'path' => 'storage/images/category/' . $imageName,
                'content_type' => $image->getClientMimeType(),
                'hash' => md5_file($image->getRealPath()),
                'order' => 1,
                'object_type' => 'App\Models\Category',
                'object_id' => $category->id,
            ]);
            $media->save();
        }

        return response()->json($category->load('medias'));
    }
}
