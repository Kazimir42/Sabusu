<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Service\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct(protected SubscriptionService $subscriptionService)
    {
    }
    public function index(): JsonResponse
    {
        $user = Auth::user();

        $subscriptions = new Subscription();
        $subscriptions = $subscriptions->with(['category', 'category.medias', 'supplier', 'supplier.medias'])->where('user_id', $user->id)->get();

        $datas = [
            'subscriptions' => $subscriptions,
            'total_monthly_cost' => $this->subscriptionService->totalMonthlyCost($subscriptions),
            'most_expensive_category' => $this->subscriptionService->mostExpensiveCategory($subscriptions),
        ];

        return response()->json($datas);
    }

    public function show($id): JsonResponse
    {
        $subscription = Subscription::findOrFail($id);

        $subscription->load(['category', 'category.medias', 'supplier', 'supplier.medias']);

        return response()->json($subscription);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $subscription = new Subscription();
        $subscription->fill([...$request->all(), 'user_id' => $user->id]);
        $subscription->save();

        return response()->json($subscription);
    }

}
