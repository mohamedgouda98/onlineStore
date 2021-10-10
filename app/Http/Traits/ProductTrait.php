<?php

namespace App\Http\Traits;


trait ProductTrait
{

    public function getAllProducts()
    {
        $products = $this->productModel::with('category', 'productColors')->get();
        foreach ($products as $product) {
            $quantity = 0;
            $colors=[];
            foreach ($product->productColors as $productColor) {
                $quantity += $productColor->quantity;
                if(!in_array($productColor->color,$colors)){
                    $colors[]=$productColor->color;
                }
            }
            $product['quantity'] = $quantity;
            $product['colors'] = $colors;
        }
        return $products;
    }
    public function getAllCategories()
    {
        return $this->categoryModel::select('id','name')->get();
    }
}
