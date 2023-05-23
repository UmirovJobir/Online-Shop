<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();
        $categories = Category::factory(10)->create();
        $tags = Tag::factory(20)->create();
        $colors = Color::factory(20)->create();
        $products = Product::factory(50)->create();
        $productImages = ProductImage::factory(70)->create();

        foreach ($products as $product){
            $tagsIds = $tags->random(5)->pluck('id');
            $colorsIds = $colors->random(5)->pluck('id');
            $product->tags()->attach($tagsIds);
            $product->colors()->attach($colorsIds);
        }
    }
}
