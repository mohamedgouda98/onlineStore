<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productModel, $categoryModel;

    public function __construct(Product $product, Category $category)
    {
        $this->productModel = $product;
        $this->categoryModel = $category;
    }
    public function index()
    {

        $products = $this->productModel::with('category')->get();
        $categories = $this->categoryModel::get();
        return view('admin.products.viewProducts', compact(['products', 'categories']));
    }

    public function store(Request $request)
    {
        if ($request->status == null) {
            $request->status == '0';
        }
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'price' => 'required',
            'main_image' => 'required|mimes:jpg,png,webp',
            'description' => 'required|min:5',
            'category_id' => 'required',
            'status' => 'required'
        ]);
        $fileName = time() . '_product.' . $request->main_image->extension();
        $request->main_image->move(public_path('images/products'), $fileName);
        $this->productModel::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'main_image' => $fileName,
            'status' => $request->status,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);
        session()->flash('done', 'Product Was Added');
        return redirect(route('admin.products'));
    }

    public function edite($id)
    {
        $products = $this->productModel::with('category')->find($id);
        if ($products) {
            $products->get();
            $categories = $this->categoryModel::get();
            return view('admin.products.upadteProducts', compact(['products', 'categories']));
        }
    }

    public function update(Request $request)
    {
        if ($request->status == null) {
            $request->status == '0';
        }
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
            'price' => 'required',
            'main_image' => 'required|mimes:jpg,png,webp',
            'description' => 'required|min:5',
            'category_id' => 'required',
            'old_image' => 'required',
            'status' => 'required'

        ]);
        if ($request->main_image != null) {
            $fileName = time() . '_product.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/products'), $fileName);
            $this->productModel->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'price' => $request->price,
                'main_image' => $fileName,
                'status' => $request->status,
                'description' => $request->description,
                'category_id' => $request->category_id
            ]);
            session()->flash('done', 'Product Was Updated');
        } else {
            $this->productModel->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'price' => $request->price,
                'main_image' => $request->old_image,
                'status' => $request->status,
                'description' => $request->description,
                'category_id' => $request->category_id
            ]);
            session()->flash('done', 'Product Was Updated');
        }
        return redirect(route('admin.products'));
    }

    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if ($product) {
            $product->delete();
            session()->flash('done', 'Product Was Deleted');
        }
        return redirect(route('admin.products'));
    }
}
