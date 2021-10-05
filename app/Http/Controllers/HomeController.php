<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ads = Ads::inRandomOrder()->limit(2)->get();
        $subAds = Ads::inRandomOrder()->limit(6)->get();
        $subAdsSizes = [400, 250, 150, 150, 250, 400];

        foreach ($subAds as $key => $subAd){
            $subAd['size'] = $subAdsSizes[$key];
        }

        $categories = Category::limit(8)->get();
        return view('index', compact('ads', 'subAds', 'categories'));
    }

    public function categoryProducts()
    {
        $products = Product::get();
        return view('product-list', compact('products'));
    }
}
