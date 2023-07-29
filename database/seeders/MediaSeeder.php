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
            'Power' => ['title' => 'bolt.svg', 'folder' => 'svg/'],
            'Internet' => ['title' => 'wifi.svg', 'folder' => 'svg/'],
            'Insurance' => ['title' => 'shield-check.svg', 'folder' => 'svg/'],
            'Mobile' => ['title' => 'mobile.svg', 'folder' => 'svg/'],
            'Magazine' => ['title' => 'newspaper.svg', 'folder' => 'svg/'],
            'Sport' => ['title' => 'face-smile.svg', 'folder' => 'svg/'],
            'Distraction' => ['title' => 'tv.svg', 'folder' => 'svg/'],
            'Transport' => ['title' => 'rocket.svg', 'folder' => 'svg/'],
            'Bank charges' => ['title' => 'credit-card.svg', 'folder' => 'svg/'],
            'Software' => ['title' => 'computer.svg', 'folder' => 'svg/'],
            'Other' => ['title' => 'elipsis-horizontal.svg', 'folder' => 'svg/'],
        ];

        foreach ($categories as $category) {
            if ($svgs[$category->title]) {
                $filepath = $svgs[$category->title]['folder'] . $svgs[$category->title]['title'];
                (new Media())->create([
                    'title' => $svgs[$category->title]['title'],
                    'order' => 1,
                    'path' => $filepath,
                    'content_type' => mime_content_type(public_path($filepath)),
                    'hash' => hash_file('md5', public_path($filepath)),
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
            'Other' => ['title' => 'puzzle.svg', 'folder' => 'svg/'],
            'Basic-Fit' => ['title' => 'Basic-Fit_logo.png', 'folder' => 'images/category/'],
            'Spotify' => ['title' => 'Spotify_logo.png', 'folder' => 'images/category/'],
            'Netflix' => ['title' => 'Netflix_logo.png', 'folder' => 'images/category/'],
            'Proton' => ['title' => 'Proton_logo.png', 'folder' => 'images/category/'],
        ];

        foreach ($suppliers as $supplier) {
            if (!empty($images[$supplier->title])) {
                $filepath = $images[$supplier->title]['folder'] . $images[$supplier->title]['title'];
                (new Media())->create([
                    'title' => $images[$supplier->title]['title'],
                    'order' => 1,
                    'path' => $filepath,
                    'content_type' => mime_content_type(public_path( $filepath)),
                    'hash' => hash_file('md5', public_path($filepath)),
                    'object_type' => 'App\Models\Supplier',
                    'object_id' => $supplier->id
                ]);
            }
        }

    }
}
