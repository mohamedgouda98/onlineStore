<?php
namespace App\Http\Traits;


trait ProductColorTrait
{

    public function getAllProducts()
    {
        return $this->productModel::select('id','name','slug')->get();
        // return $this->productModel::with('category')->select('id','name','slug')->get();
    }
    public function getAllColors()
    {
        return $this->colorModel::select('id','name')->get();
    }
    public function getAllProductColors()
    {
        return $this->productColorModel::with('product','color')->get();
    }
}
