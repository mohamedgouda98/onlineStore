<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\UsersTrait;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private $userModel;
    private $roleModel;
    private $userRoleModel;

    use UsersTrait;

    public function __construct(User $user, UserRole $userRole, Role $role)
    {
        $this->userModel = $user;
        $this->roleModel = $role;
        $this->userRoleModel = $userRole;
    }
    //////////////////////////
    public function index()
    {
        $users = $this->getAllUsers();
        return view('admin.users', compact([ 'users']));
    }
    //////////////////////////
    public function editStatus($id)
    {
        $this->toggleStatus($this->userModel::where('id', $id)->first());
        return redirect()->back();
    }
 
    ////////////////////////////////
    public function delete($id)
    {
        $user = $this->userModel::where('id', $id)->first();
        if (!$user) {

            session()->flash('error', 'User was not Found !');
            return redirect()->back();
        }
        $user->delete();
        session()->flash('done', 'User Has Been Deleted !');
        return redirect()->back();
    }
}
