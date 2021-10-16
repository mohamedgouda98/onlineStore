<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Cart;
use App\Models\ProductColor;
use App\Rules\CheckStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    use ApiResponseTrait;

    /**
     * @param Request $request
     * get request ['product_color_id', 'quantity']
     */
    public function addToCart(Request $request)
    {
        $validation = Validator::make($request->all(),[
           'product_color_id' => ['required', 'exists:product_colors,id', new CheckStock($request->quantity)],
            'quantity' => 'required'
        ]);

        if($validation->fails())
        {
            return $this->apiResponse(400, 'validation errors', $validation->errors());
        }

        $productColor = ProductColor::where('id', $request->product_color_id)->with('product')->first();

        Cart::create([
            'product_color_id' => $request->product_color_id,
            'quantity' => $request->quantity,
            'user_id' => auth()->user()->id,
            'total_price' => $request->quantity * $productColor->product->price
        ]);

        return $this->apiResponse(200, 'Added to cart');
    }
}
