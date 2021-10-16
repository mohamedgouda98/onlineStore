<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' =>'test',
            'image' => 'test.png',
            'icon' => 'test'
        ]);
        $products = [
            ['name' => 'test', 'main_image' =>'test1.png', 'price' => 10, 'category_id'=>1, 'slug'=> 'test', 'description' => 'testing', 'status'=> 1],
            ['name' => 'test', 'main_image' =>'test1.png', 'price' => 10, 'category_id'=>1, 'slug'=> 'test', 'description' => 'testing', 'status'=> 1],
            ['name' => 'test', 'main_image' =>'test1.png', 'price' => 10, 'category_id'=>1, 'slug'=> 'test', 'description' => 'testing', 'status'=> 1],
            ['name' => 'test', 'main_image' =>'test1.png', 'price' => 10, 'category_id'=>1, 'slug'=> 'test', 'description' => 'testing', 'status'=> 1],
            ['name' => 'test', 'main_image' =>'test1.png', 'price' => 10, 'category_id'=>1, 'slug'=> 'test', 'description' => 'testing', 'status'=> 1],
        ];

        foreach ($products as $product)
        {
            Product::create([
                'name' => $product['name'],
                'main_image' => $product['main_image'],
                'price' => $product['price'],
                'category_id' => $product['category_id'],
                'description' => $product['description'],
                'slug' => $product['slug'],
                'status' => $product['status'],
            ]);
        }
    }
}
