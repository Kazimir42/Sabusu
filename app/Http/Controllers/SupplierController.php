<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(Category $category): JsonResponse
    {
        return response()->json($category->suppliers()->with('medias')->get());
    }

    public function store(Request $request, Category $category): JsonResponse
    {
        $user = Auth::user();

        $supplier = new Supplier();
        $supplier->create([
            'title' => $request->title,
            'category_id' => $category->id,
            'user_id' => $user->id,
        ]);
        $supplier->save();

        return response()->json($supplier->load('medias'));
    }
}
