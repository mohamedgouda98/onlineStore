<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function colors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id')->with('color');
    }
}
