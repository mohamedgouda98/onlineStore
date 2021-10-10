<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductColor;
use App\Rules\CheckStock;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_color_id' => ['required','exists:product_colors,id', new CheckStock($request->quantity)],
            'quantity' => 'required',
        ]);

        $productColor = ProductColor::where('id', $request->product_color_id)->with('product')->first();
       $cart =  Cart::create([
            'product_color_id' => $request->product_color_id,
            'quantity' => $request->quantity,
            'user_id' => auth()->user()->id,
            'total_price' => $request->quantity * $productColor->product->price
        ]);


        session()->flash('done','Product was added');
        return redirect()->back();

    }
}
