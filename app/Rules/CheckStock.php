<?php

namespace App\Rules;

use App\Models\ProductColor;
use Illuminate\Contracts\Validation\Rule;

class CheckStock implements Rule
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
         return ProductColor::where([ ['id', $value], ['quantity', '>' , $this->count] ])->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'this product out of stock';
    }
}
