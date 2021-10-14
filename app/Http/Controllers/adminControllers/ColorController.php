<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\colorTrait;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    private $colorModel;
    use colorTrait;
    public function __construct(Color $color)
    {
        $this->colorModel = $color;
    }
    public function index()
    {
        $coloritems = $this->colorModel::with('productColors')->get();
       $colors = $this->addProductColorsCount($coloritems);
        return view('admin.colors', compact('colors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $this->colorModel::create([
            'name' => $request->name
        ]);
        Session()->flash('done', 'Color Has Been Added !');
        return redirect()->back();
    }
    public function delete($id)
    {
        $color = $this->colorModel::where('id', $id)->first();
        if (!$color) {
            Session()->flash('error', 'Color is not Found !');
            return redirect()->back();
        }
        $color->delete();
        Session()->flash('done', 'Color Has Been Deleted !');
        return redirect()->back();
    }
}
