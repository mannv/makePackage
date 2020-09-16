<?php

namespace Plum\LaravelPermission\Models;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{

    public function getAll()
    {
        return $this->paginate();
    }

    public function createNewRole(array $params)
    {
        return $this->create(['name' => Str::slug($params['name']), 'name_display' => $params['name_display']]);
    }
}
