<?php

namespace App\Http\Controllers\adminsControllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\AdminsTrait;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    private $userModel;
    private $roleModel;
    private $userRoleModel;

    use AdminsTrait;

    public function __construct(User $user, UserRole $userRole, Role $role)
    {
        $this->userModel = $user;
        $this->roleModel = $role;
        $this->userRoleModel = $userRole;
    }
    //////////////////////////
    public function index()
    {

        $admins = $this->getAllAdmins();
        $roles = $this->getAllRoles();
        return view('admin.admins', compact(['roles', 'admins']));
    }
    // ////////////////////////
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email|email:rfc,dns',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);
        $admin = $this->userModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $this->userRoleModel::create([
            'role_id' => $request->role_id,
            'user_id' => $admin->id,
        ]);
        session()->flash('done', 'Admin Has Been Added !');
        return redirect(route('owner.admins'));
    }
    //////////////////////////
    public function editStatus($id)
    {
        $this->toggleStatus($this->userModel::where('id', $id)->first());
        return redirect()->back();
    }
 
    // ////////////////////////////////
    public function delete($id)
    {
        $admin = $this->userModel::where('id', $id)->first();
        if (!$admin) {

            session()->flash('error', 'Admin was not Found !');
            return redirect()->back();
        }
        $admin->delete();
        session()->flash('done', 'Admin Has Been Deleted !');
        return redirect()->back();
    }
}
