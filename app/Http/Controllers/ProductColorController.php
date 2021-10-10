<?php

namespace App\Http\Controllers;

use App\Http\Traits\ProductColorTrait as TraitsProductColorTrait;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;


class ProductColorController extends Controller
{
    private $productModel;
    private $colorModel;
    private $productColorModel;

    use TraitsProductColorTrait;

    public function __construct(Product $product, Color $color, ProductColor $productColor)
    {
        $this->productModel = $product;
        $this->colorModel = $color;
        $this->productColorModel = $productColor;
    }
    //////////////////////////
    public function index()
    {
        $products = $this->getAllProducts();
        $colors = $this->getAllColors();
        $productColors = $this->getAllProductColors();
        return view('admin.productColors', compact(['products', 'colors', 'productColors']));
    }
    ////////////////////////
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'quantity' => 'required',
        ]);
        $imagePath = time() . '_productColor.' . $request->image->extension();
        $request->image->move(public_path('images/productColorImages'), $imagePath);
        $this->productColorModel::create([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'image' => $imagePath,
            'quantity' => $request->quantity,
        ]);
        session()->flash('done', 'ProductColor Has Been Added !');
        return redirect(route('admin.productColor'));
    }

    ///////////////////////////////
    public function edit($id)
    {
        $productColorItem = $this->productColorModel::where('id', $id)->with('product', 'color')->first();
        $products = $this->getAllProducts();
        $colors = $this->getAllColors();
        return view('admin.productColorItem', compact(['productColorItem', 'products', 'colors']));
    }
    ////////////////////////////////
    public function update(Request $request, $id)
    {
        if ($request->newImage) {

            $request->validate([
                'product_id' => 'required|exists:products,id',
                'color_id' => 'required|exists:colors,id',
                'newImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                'quantity' => 'required',
            ]);
            $imagePath = time() . '_productColor.' . $request->newImage->extension();
            $request->newImage->move(public_path('images/productColorImages'), $imagePath);
            @unlink(public_path("images/productColorImages/$request->image"));
        } else {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'color_id' => 'required|exists:colors,id',
                'image' => 'required',
                'quantity' => 'required',
            ]);

            $imagePath = $request->image;
        }

        $this->productColorModel::where('id', $id)->update([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'image' => $imagePath,
            'quantity' => $request->quantity,
        ]);
        session()->flash('done', 'ProductColor Has Been Updated !');
        return redirect(route('admin.productColor'));
    }
    ////////////////////////////////
    public function delete($id)
    {
        $productColorItem = $this->productColorModel::where('id', $id)->first();
        if (!$productColorItem) {

            session()->flash('error', 'ProductColor was not Found !');
            return redirect(route('admin.productColor'));
        }
        @unlink(public_path("images/productColorImages/$productColorItem->image"));
        $productColorItem->delete();
        session()->flash('done', 'ProductColor Has Been Deleted !');
        return redirect(route('admin.productColor'));
    }

    public function productDetails($slug)
    {
//        $product = Product::where('slug', $slug)->with('colors')->first();

        $product = Product::where('slug', $slug)->whereHas('colors', function($query){
            return $query->where('quantity' , '>', 0);
        })->with('colors')->first();

        return view('product-detail', compact('product'));
    }
}
