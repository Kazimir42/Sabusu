<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index(): JsonResponse
    {
        $user = Auth::user();

        $subscriptions = $user->subscriptions()->get();
        return response()->json($subscriptions);
    }

    public function show($id): JsonResponse
    {
        $subscription = Subscription::findOrFail($id);

        return response()->json($subscription);
    }

    public function store(Request $request)
    {
        dd($request);
    }

}
