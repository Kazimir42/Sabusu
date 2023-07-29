<?php

namespace App\Service;

use App\Enums\FrequencyEnum;
use App\Models\Category;

class SubscriptionService
{

    public function __construct()
    {
    }

    public function totalMonthlyCost($subscriptions): float
    {
        $totalCost = 0;

        foreach ($subscriptions as $subscription) {
            $totalCost += $this->monthlyCost($subscription);
        }

        return round($totalCost, 2);
    }

    public function mostExpensiveCategory($subscriptions)
    {
        $categories = [];

        foreach ($subscriptions as $subscription) {
            if (array_key_exists($subscription->category_id, $categories)) {
                $categories[$subscription->category_id] += $this->monthlyCost($subscription);
            } else {
                $categories[$subscription->category_id] = $this->monthlyCost($subscription);
            }
        }

        $highestValue = max($categories);
        $highestIndex = array_search($highestValue, $categories);

        return Category::find($highestIndex);
    }

    private function monthlyCost($subscription): float|int
    {
        $cost = 0;

        switch ($subscription->frequency) {
            case FrequencyEnum::MONTHLY->value:
                $cost = round($subscription->amount, 2);
                break;
            case FrequencyEnum::QUARTERLY->value:
                $cost = round($subscription->amount / 3, 2);
                break;
            case FrequencyEnum::YEARLY->value:
                $cost = round($subscription->amount / 12, 2);
                break;
            case FrequencyEnum::BI_WEEKLY->value:
                $cost = round($subscription->amount * 2, 2);
                break;
        }

        return $cost;
    }

}
