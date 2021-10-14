<?php


namespace App\Http\Traits;


trait categoryTrait
{

    public function productsCount($categories)
    {
        foreach ($categories as $category) {
            $category['countOfProducts'] = count($category->products);
           if ($category->countOfProducts) {
               $counts=0;
               foreach($category->products as $product){
                   $counts += count($product->productColors);
               }
               $category['countOfAllProductColors']=$counts;
           }else{
            $category['countOfAllProductColors']=0;
           }
        }
        return $categories;
    }
    public function addColorsAndQuantity($category)
    {
        foreach ($category->products as $product) {
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
        return $category;
    }
}
