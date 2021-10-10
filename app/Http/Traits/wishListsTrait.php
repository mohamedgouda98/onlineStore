<?php

namespace App\Http\Traits;


trait WishListsTrait
{

    public function getAllWishLists()
    {
        return $this->wishListModel::with('productColor')->get();
    }
    
    
}
