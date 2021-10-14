<?php

namespace App\Http\Traits;


trait UsersTrait
{

    public function getAllUsers()
    {
        $usersRolesId = $this->roleModel::wherein('name', ['user'])->pluck('id');
        return $this->userModel::whereHas('roles', function ($query) use ($usersRolesId) {
            return $query->wherein('role_id', $usersRolesId);
        })->with('addresses')->get();
    }
   
    public function toggleStatus($user)
    {
        $user->status=!$user->status;
        $user->save();
    }
    public function getUserRole(){
        return $this->roleModel::where('name','user')->select('id')->first();
    }
    
    
}
