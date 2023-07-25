<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class SupplierController extends Controller
{
    public function index(Category $category): JsonResponse
    {
        return response()->json($category->suppliers()->get());
    }
}
