<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesArray = [
            'Power' => [
                ['title' => 'Other'],
            ],
            'Internet' => [
                ['title' => 'Other'],
            ],
            'Insurance' => [
                ['title' => 'Other'],
            ],
            'Mobile' => [
                ['title' => 'Other'],
            ],
            'Magazine' => [
                ['title' => 'Other'],
            ],
            'Sport' => [
                ['title' => 'Basic-Fit'],
                ['title' => 'Other'],
            ],
            'Distraction' => [
                ['title' => 'Spotify'],
                ['title' => 'Netflix'],
                ['title' => 'Other'],
            ],
            'Transport' => [
                ['title' => 'Other'],
            ],
            'Bank charges' => [
                ['title' => 'Other'],
            ],
            'Software' => [
                ['title' => 'Proton'],
                ['title' => 'Other'],
            ],
            'Other' => [
                ['title' => 'Other'],
            ],
        ];

        Category::all()->each(function (Category $category) use ($categoriesArray) {
            foreach ($categoriesArray[$category->title] as $categoryArray) {
                (new Supplier())->create([
                    'category_id' => $category->id,
                    'title' => $categoryArray['title']
                ]);
            }
        });
    }
}
