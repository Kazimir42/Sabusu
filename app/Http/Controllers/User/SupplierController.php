<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class SupplierController extends Controller
{
    public function index(User $user): JsonResponse
    {
        return response()->json($user->suppliers()->get()->load('medias'));
    }

    public function show(User $user, $id): JsonResponse
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->load(['category', 'category.medias', 'medias']);

        return response()->json($supplier);
    }

    public function destroy(User $user, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
    }
}
