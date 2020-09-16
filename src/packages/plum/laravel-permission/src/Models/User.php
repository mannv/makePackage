<?php

namespace Plum\LaravelPermission\Models;

use \App\Models\User as BaseUser;
use Spatie\Permission\Models\Role;

class User extends BaseUser
{

    public function role() {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id');
    }

    public function getAll()
    {
        $q = request()->get('q');
        $condition = $this->with(['role'])
            ->where('name', 'LIKE', '%' . $q . '%')
            ->orWhere('email', 'LIKE', '%' . $q . '%');
        return $condition->paginate();
    }
}
