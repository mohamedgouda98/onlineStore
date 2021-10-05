<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AuthSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Setup Roles>>>
        $roles = ['owner','admin', 'user'];

        foreach ($roles as $role)
        {
            Role::create([
                'name' => $role
            ]);
        }

        // create Owner acount
        $ownerRole = Role::where('name', 'owner')->first();
        $owner = User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        UserRole::create([
            'role_id' => $ownerRole->id,
            'user_id' => $owner->id
        ]);

        // create Admins acount
        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        UserRole::create([
            'role_id' => $adminRole->id,
            'user_id' => $admin->id
        ]);

        //create USer Account
        $userRole = Role::where('name', 'user')->first();
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        UserRole::create([
            'role_id' => $userRole->id,
            'user_id' => $user->id
        ]);

    }
}
