<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    public function index(Category $category): JsonResponse
    {
        $user = Auth::user();

        $categories = $category->suppliers()->with('medias')->where('user_id', '=', null)->orWhere('user_id', '=', $user->id)->get();
        return response()->json($categories);
    }

    public function store(Request $request, Category $category): JsonResponse
    {
        $user = Auth::user();

        $supplier = Supplier::create([
            'title' => $request->title,
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $supplier->save();

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
                'object_type' => 'App\Models\Supplier',
                'object_id' => $supplier->id,
            ]);
            $media->save();
        }

        return response()->json($supplier->load('medias'));
    }
}
