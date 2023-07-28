<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories[] = ['title' => 'Power'];
        $categories[] = ['title' => 'Internet'];
        $categories[] = ['title' => 'Insurance'];
        $categories[] = ['title' => 'Magazine'];
        $categories[] = ['title' => 'Sport'];
        $categories[] = ['title' => 'Distraction'];
        $categories[] = ['title' => 'Transport'];
        $categories[] = ['title' => 'Bank charges'];
        $categories[] = ['title' => 'Other'];

        foreach ($categories as $category) {
            (new Category())->create($category);
        }
    }
}
