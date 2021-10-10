<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'main_image', 'description', 'status', 'price', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productColors()
    {
        return   $this->hasMany(ProductColor::class, 'product_id', 'id')->with('color');
       
    }
}
