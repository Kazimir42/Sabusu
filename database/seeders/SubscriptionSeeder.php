<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subscription;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::all()->take(5)->each(function (Category $category) {
            Subscription::factory()->count(5)->create([
                'category_id' => $category->id,
                'supplier_id' => $category->suppliers()->first()->id,
            ]);
        });

        (new Supplier())->create([
            ''
        ]);


    }
}
