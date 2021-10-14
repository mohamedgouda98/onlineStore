<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ProductTrait as TraitsProductTrait;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private $productModel;
    private $colorModel;
    private $CategoryModel;
    private $productColorModel;

    use TraitsProductTrait;

    public function __construct(Product $product, Color $color, ProductColor $productColor, Category $category)
    {
        $this->productModel = $product;
        $this->colorModel = $color;
        $this->categoryModel = $category;
        $this->productColorModel = $productColor;
    }
    //////////////////////////
    public function index()
    {
        $products = $this->getAllProducts();
        $categories = $this->getAllCategories();
        return view('admin.products', compact(['products','categories']));
    }
    ////////////////////////
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'price' => 'required|min:1',
            'description' => 'required|min:10',
        ]);
        $imagePath = time() . '_product.' . $request->main_image->extension();
        $request->main_image->move(public_path('images/ProductsImages'), $imagePath);
        $status=1;
        if(!$request->status)
        {
            $status =0;
        }
        $this->productModel::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'main_image' => $imagePath,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $status,
        ]);
        session()->flash('done', 'Product Has Been Added !');
        return redirect(route('admin.product'));
    }

    ///////////////////////////////
    public function edit($id)
    {
        $productItem = $this->productModel::where('id', $id)->with('category','productColors')->first();
        $categories  = $this->getAllCategories();
        return view('admin.productItem', compact(['productItem', 'categories']));
    }
    ////////////////////////////////
    public function update(Request $request, $id)
    {
        if ($request->newImage) {

            $request->validate([
                'name' => 'required|min:3',
                'slug' => 'required|min:3',
                'category_id' => 'required|exists:categories,id',
                'newImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                'price' => 'required|min:1',
                'description' => 'required|min:10',
            ]);
            $imagePath = time() . '_product.' . $request->newImage->extension();
            $request->newImage->move(public_path('images/ProductsImages'), $imagePath);
            @unlink(public_path("images/ProductsImages/$request->main_image"));
        } else {
            $request->validate([
                'name' => 'required|min:3',
                'slug' => 'required|min:3',
                'category_id' => 'required|exists:categories,id',
                'main_image' => 'required',
                'price' => 'required|min:1',
                'description' => 'required|min:10',

            ]);

            $imagePath = $request->main_image;
        }

        $this->productModel::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'main_image' => $imagePath,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        session()->flash('done', 'Product Has Been Updated !');
        return redirect(route('admin.product'));
    }
    ////////////////////////////////
    public function delete($id)
    {
        $productItem = $this->productModel::where('id', $id)->first();
        if (!$productItem) {

            session()->flash('error', 'Product was not Found !');
            return redirect(route('admin.product'));
        }
        @unlink(public_path("images/ProductImages/$productItem->main_image"));
        $productItem->delete();
        session()->flash('done', 'Product Has Been Deleted !');
        return redirect(route('admin.product'));
    }

    public function productDetails($slug)
    {
        //        $product = Product::where('slug', $slug)->with('colors')->first();

        $product = Product::where('slug', $slug)->whereHas('colors', function ($query) {
            return $query->where('quantity', '>', 0);
        })->with('colors')->first();

        return view('product-detail', compact('product'));
    }
}
