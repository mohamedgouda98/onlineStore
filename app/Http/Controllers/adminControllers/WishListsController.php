<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\WishListsTrait;
use App\Models\WishList;

class WishListsController extends Controller
{
    private $wishListModel;
    use WishListsTrait;

    public function __construct(WishList $wishList)
    {
        $this->wishListModel = $wishList;
       
    }
    //////////////////////////
    public function index()
    {
        $wishLists = $this->getAllWishLists();
        return view('admin.wishLists', compact([ 'wishLists']));
    }
        
}
