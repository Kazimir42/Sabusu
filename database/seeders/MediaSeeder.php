<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ///////////////////////////////////////////
        // Categories
        ///////////////////////////////////////////

        $categories = Category::all();

        $svgs = [
            'Power' => ['title' => 'bolt.svg'],
            'Internet' => ['title' => 'wifi.svg'],
            'Insurance' => ['title' => 'shield-check.svg'],
            'Mobile' => ['title' => 'mobile.svg'],
            'Magazine' => ['title' => 'newspaper.svg'],
            'Sport' => ['title' => 'face-smile.svg'],
            'Distraction' => ['title' => 'tv.svg'],
            'Transport' => ['title' => 'rocket.svg'],
            'Bank charges' => ['title' => 'credit-card.svg'],
            'Software' => ['title' => 'computer.svg'],
            'Other' => ['title' => 'elipsis-horizontal.svg'],
        ];

        foreach ($categories as $category) {
            if ($svgs[$category->title]) {
                (new Media())->create([
                    'title' => $svgs[$category->title]['title'],
                    'order' => 1,
                    'path' => 'svg/' . $svgs[$category->title]['title'],
                    'content_type' => 'image/svg+xml',
                    'hash' => 'test',
                    'object_type' => 'App\Models\Category',
                    'object_id' => $category->id
                ]);
            }
        }

        ///////////////////////////////////////////
        // Suppliers
        ///////////////////////////////////////////

        $suppliers = Supplier::all();

        $images = [
            //'Other' => ['title' => 'Other_logo.png'],
            'Basic-Fit' => ['title' => 'Basic-Fit_logo.png'],
            'Spotify' => ['title' => 'Spotify_logo.png'],
            'Netflix' => ['title' => 'Netflix_logo.png'],
            'Proton' => ['title' => 'Proton_logo.png'],
        ];

        foreach ($suppliers as $supplier) {
            if ($images[$supplier->title]) {
                (new Media())->create([
                    'title' => $images[$supplier->title]['title'],
                    'order' => 1,
                    'path' => 'category/' . $images[$supplier->title]['title'],
                    'content_type' => 'image/png',
                    'hash' => 'test',
                    'object_type' => 'App\Models\Supplier',
                    'object_id' => $supplier->id
                ]);
            }
        }

    }
}
