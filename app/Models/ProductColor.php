<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'color_id', 'image', 'quantity'];

public function product()
{
    return $this->belongsTo(Product::class,'product_id','id')->select('id','name','slug','price');
}

public function color()
{
    return $this->belongsTo(Color::class,'color_id','id')->select('id','name');
}

}
