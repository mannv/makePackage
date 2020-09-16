<?php

namespace Plum\LaravelPermission\Models;

use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{

    public function getAll()
    {
        return $this->paginate();
    }
}
