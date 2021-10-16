<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['product_color_id', 'quantity', 'user_id', 'total_price'];

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id')->with('product');
    }
}
