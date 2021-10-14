<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Rules\RePasswordValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function adminLoginPage()
    {
        return view('admin.login');
    }

    public function userLoginPage()
    {
        return view('login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password'=>'required'
        ]);
        $userData = $request->only('email', 'password');
        $userData['status']=1;
        if(Auth::attempt($userData))
        {
            return redirect(route('admin.home'));
        }
        session()->flash('error', 'Email or Password Invalid');
        return redirect(route('admin.loginPage'));

    }

    public function userLogin(Request $request)
    {
        $userData = $request->only('email', 'password');
        $userData['status']=1;
        if(Auth::attempt($userData))
        {
            return redirect(route('user.account'));
        }
        session()->flash('error', 'Email or Password Invalid');
        return redirect(route('user.loginPage'));

    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            're-password' => ['required', 'min:8', new RePasswordValidation($request->password)]
        ]);

       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password)
       ]);
       $role = Role::where('name', 'user')->first();
       UserRole::create([
           'user_id' => $user->id,
           'role_id' => $role->id
       ]);
        $this->userLogin($request);
       return redirect(route('user.account'));
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('admin.loginPage'));
    }
}
