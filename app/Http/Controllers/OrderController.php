<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductColor;
use App\Rules\checkCartCount;
use App\Rules\checkCartExists;
use App\Rules\CheckStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->with('productColor')->get();
        $sumTotal = 0;
        foreach ($carts as $cart)
        {
            $sumTotal += $cart->total_price;
        }
        $data = [
            "carts" => $carts,
            "total" => $sumTotal,
            "shipping" => 40,
            "total_after_shipping" => $sumTotal + 40,
        ];
        return view('cart', compact('data'));
    }

    public function deleteCart(Request $request)
    {
       $request->validate([
           'cart_id' => 'required|exists:carts,id'
       ]);

       Cart::find($request->cart_id)->delete();

       session()->flash('done', 'Cart Item Was Deleted');
       return redirect()->back();
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_color_id' => ['required','exists:product_colors,id',
                new CheckStock($request->quantity), new checkCartExists() ],
            'quantity' => 'required',
        ]);

        $productColor = ProductColor::where('id', $request->product_color_id)->with('product')->first();
       Cart::create([
            'product_color_id' => $request->product_color_id,
            'quantity' => $request->quantity,
            'user_id' => auth()->user()->id,
            'total_price' => $request->quantity * $productColor->product->price
        ]);

        session()->flash('done','Product was added');
        return redirect()->back();

    }


    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => ['required','exists:carts,id', new checkCartCount($request->count)],
            'count' => 'required'
        ]);
        $cart = Cart::where('id', $request->cart_id)->with('productColor')->first();
        $cart->update([
            'quantity' => $request->count,
            'total_price' => $request->count * $cart->productColor->product->price
        ]);
        session()->flash('done','cart item was updated');
        return redirect()->back();
    }

    public function checkoutCart(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:11',
            'city' => 'required|min:3',
            'details' => 'required|min:5',
        ]);

        $address = Address::create([
            'phone' => $request->phone,
            'city' => $request->city,
            'detail' => $request->details,
            'user_id' => Auth::user()->id
        ]);

        $carts = Cart::where('user_id', Auth::user()->id)->with('productColor')->get();

        $sumTotal = 0;
        foreach ($carts as $cart)
        {
            if($cart->productColor->quantity <  $cart->quantity)
            {
                return redirect()->back()->withErrors(['stock', 'product ' . $cart->productColor->product->name . 'out of stock']);
            }
            $sumTotal += $cart->total_price;
        }

        $sumTotal += 40;

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'address_id' => $address->id,
            'total_price' => $sumTotal,
            'status' => false
        ]);

        foreach ($carts as $cart)
        {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_color_id' => $cart->product_color_id,
                'quantity' => $cart->quantity,
                'sub_total' => $cart->total_price
            ]);

            $cart->delete();
        }

        session()->flash('done', 'Order Was Created with code #' . $order->id);
        return redirect()->back();

    }
}
