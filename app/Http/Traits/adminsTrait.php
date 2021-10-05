<?php

namespace App\Http\Traits;


trait AdminsTrait
{

    public function getAllAdmins()
    {
        $adminsRolesIds = $this->roleModel::wherein('name', ['admin', 'owner'])->pluck('id');
        return $this->userModel::whereHas('roles', function ($query) use ($adminsRolesIds) {
            return $query->wherein('role_id', $adminsRolesIds);
        })->with('roles')->get();
    }
    public function getAllRoles()
    {
        return $this->roleModel::where('name', '!=', 'user')->get();
    }
    public function toggleStatus($admin)
    {
        $admin->status=!$admin->status;
        $admin->save();
    }
}
