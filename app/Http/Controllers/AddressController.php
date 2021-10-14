<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $addressModel;
    private $usersModel;
    public function __construct(Address $address , User $user)
    {
        $this->addressModel=$address;
        $this->usersModel=$user;
    }

    public function indexView()
    {
        $addressTable=$this->addressModel::with('usersAddresses')->get();
        $users=$this->usersModel::get();

        return view('admin.address',compact(['addressTable','users']));
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'city'=>'required|min:3',
            'phone'=>'required|digits:11',
            'details'=>'required|min:10',
            'user_id'=>'required|exists:users,id'
        ]);

        $this->addressModel::create([
            'city'=>$request->city,
            'phone'=>$request->phone,
            'detail'=>$request->details,
            'user_id'=>$request->user_id
        ]);

        session()->flash('done','Address Is Added');
        return redirect(route('admin.address.view'));
    }

    public function deleteAddress($id)
    {
        $address=$this->addressModel::find($id)->first();
        if($address)
        {
            $address->delete();
            session()->flash('done','Address Is Deleted');
            return redirect(route('admin.address.view'));
        }
        return redirect(route('admin.address.view'));
    }

    public function updateAddress(Request $request,$id)
    {
        $request->validate([
            'city'=>'required|min:3',
            'phone'=>'required|digits:11',
            'detail'=>'required|min:10',
            'user_id'=>'required|exists:users,id'
        ]);

        $address=$this->addressModel::find($id)->first();

        if($address)
        {
            $address->update([
                'city'=>$request->city,
                'phone'=>$request->phone,
                'detail'=>$request->detail,
                'user_id'=>$request->user_id
            ]);

            session()->flash('done','Address Is Updated');
            return redirect(route('admin.address.view'));
        }
        return redirect(route('admin.address.view'));
    }




}
