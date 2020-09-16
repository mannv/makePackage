<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class IndexController
{
    public function index()
    {
//        $role = Role::create(['name' => 'bien tap vien']);
//        $permission = Permission::create(['name' => 'add post']);
//        dump($role);
//        dump($permission);

        $user = User::findOrFail(1);
        $role = Role::findById(1);
        $permission = Permission::findById(1);

        if ($user instanceof User) {
            $user->assignRole($role);
            $user->givePermissionTo($permission);
        }

//        if ($role instanceof Role) {
//            $role->givePermissionTo($permission);
//        }
//
//        if ($permission instanceof Permission) {
//            $permission->assignRole($role);
//        }
//


        return 'ok';
    }

    public function demo()
    {
        dd('ok');
    }

    public function postJob()
    {
        return 'ok';
    }
}
