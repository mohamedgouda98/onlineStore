<?php


namespace App\Http\Traits;


trait colorTrait
{

    public function addProductColorsCount($colors)
    {
        foreach ($colors as $color) {
            $color['countOfProductColors'] = count($color->productColors);
        }
        return $colors;
    }
}
