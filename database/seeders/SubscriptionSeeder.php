<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subscription;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spotify = Supplier::where('title', 'Spotify')->first();
        (new Subscription())->create([
            'title' => 'Spotify Rémi',
            'frequency' => 1,
            'amount' => 10,
            'subscribed_at' => Carbon::now()->subMonth(12),
            'payment_at' => Carbon::now()->subDay(10),
            'user_id' => 1,
            'supplier_id' => $spotify->id,
            'category_id' => $spotify->category->id
        ]);
    }
}
