<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use GuzzleHttp\Promise\Create;

class SystemController extends Controller
{
    public function ads (Request $request){
        
      
        
            $request->validate([
               
                'image' => 'required|mimes:jpg,png',
                'url' => 'required|min:3',
                'slug' => 'required|min:5'
            ]);
            
    
            $fileName = time() . '_ads.' . $request->image->extension();
            $request->image->move(public_path('images/ads'), $fileName);
            
            
            Ads::create([
                
                'image' => $fileName,
                'url' => $request->url,
                'slug' => $request->slug
            ]);
   
            session()->flash('done', 'ads Was Added');
            
            // return redirect(route('admin.ads'));
            
    
    
        
      return view('admin.ads');
    }
    // public function update(Request $request,$id){
    //     $request->validate([
               
    //         'image' => 'required|mimes:jpg,png',
    //         'url' => 'required|min:3',
    //         'slug' => 'required|min:5'
    //     ]);
        

    //     $fileName = time() . '_ads.' . $request->image->extension();
    //     $request->image->move(public_path('images/ads'), $fileName);
        
        
    //     Ads::find($id)->update([
            
    //         'image' => $fileName,
    //         'url' => $request->url,
    //         'slug' => $request->slug
    //     ]);
    //     return redirect(route('admin.ads'));
    // }
    
}
