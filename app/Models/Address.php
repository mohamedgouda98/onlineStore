<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable =['city','detail','phone','user_id'];

    public function usersAddresses()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
