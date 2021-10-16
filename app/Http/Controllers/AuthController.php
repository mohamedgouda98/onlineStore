<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
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
    use ApiResponseTrait;

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
        if(Auth::attempt($userData))
        {
            return redirect(route('admin.home'));
        }
        session()->flash('error', 'Email or Password Invalid');
        return redirect(route('admin.loginPage'));

    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $userData = $request->only('email', 'password');
        if(Auth::attempt($userData))
        {
            return redirect(route('user.account'));
        }

        return redirect()->back()->withErrors(['auth', 'Email or Password Invalid']);

    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->apiResponse(401, 'Unauthorized');
        }

        return $this->apiResponse(200, 'done', null, $token);
    }

//    protected function respondWithToken($token)
//    {
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'expires_in' => auth()->factory()->getTTL() * 60
//        ]);
//    }

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
