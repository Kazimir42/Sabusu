<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'frequency' => rand(1, 4),
            'cost' => fake()->randomDigit(),
            'subscribed_at' => fake()->dateTimeBetween(),
            'payment_at' => fake()->dateTimeBetween(),
            'user_id' => 1
        ];
    }
}
