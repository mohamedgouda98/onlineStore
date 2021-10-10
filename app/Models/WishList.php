<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id')->with('product','color');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
