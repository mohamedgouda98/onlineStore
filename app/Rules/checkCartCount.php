<?php

namespace App\Rules;

use App\Models\Cart;
use Illuminate\Contracts\Validation\Rule;

class checkCartCount implements Rule
{
    private $count;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($count)
    {
        $this->count = $count;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $cart = Cart::where('id', $value)->with('productColor')->first();
        if($cart->productColor->quantity > $this->count)
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Stock is limited';
    }
}
