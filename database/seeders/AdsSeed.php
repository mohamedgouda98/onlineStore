<?php

namespace Database\Seeders;

use App\Models\Ads;
use Illuminate\Database\Seeder;

class AdsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            ['image' => 'test1.png', 'url' => 'test.com', 'slug' => 'test 1'],
            ['image' => 'test2.png', 'url' => 'test2.com', 'slug' => 'test 2'],
            ['image' => 'test3.png', 'url' => 'test3.com', 'slug' => 'test 3'],
        ];

        foreach ($ads as $ad)
        {
            Ads::create([
                'image' => $ad['image'],
                'url' => $ad['url'],
                'slug' => $ad['slug'],
            ]);
        }
    }
}
