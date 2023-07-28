<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories
        $categories = Category::all();

        $svgs = [
            'Power' => 'bolt.svg',
        ];

        foreach ($categories as $category) {
            (new Media())->create([
                'title' => $svgs[$category->title],
                'path' => 'svg/' . $svgs[$category->title],
                'content_type' => 'image/svg+xml',
                'hash' => 'test',
                'object_type' => 'App\Models\Category',
                'object_id' => $category->id
            ]);
        }

    }
}
