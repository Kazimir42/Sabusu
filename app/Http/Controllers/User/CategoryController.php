<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    public function index(User $user): JsonResponse
    {
        return response()->json($user->categories()->get()->load('medias'));
    }

    public function show(User $user, $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->load(['medias']);

        return response()->json($category);
    }

    public function destroy(User $user, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
