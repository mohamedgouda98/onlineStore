<?php

namespace App\Rules;

use App\Models\Cart;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class checkCartExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return Cart::where([ ['product_color_id', $value], ['user_id', Auth::user()->id] ])->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This Product Color is exists';
    }
}
