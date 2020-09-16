<?php

namespace Plum\LaravelPermission\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Plum\LaravelPermission\Models\Role;
use Plum\LaravelPermission\Requests\RoleRequest;

class RoleController extends BaseController
{
    /**
     * @var Role
     */
    private $role;

    public function __construct(Role $user)
    {
        $this->role = $user;
    }

    public function index()
    {
        $roles = $this->role->getAll();
        return view('plum::role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('plum::role.create');
    }

    public function store(RoleRequest $request)
    {
        dd($request->all());
    }

    public function edit($id)
    {
        dd($id);
    }

    public function update($id)
    {
        dump(request()->all());
        dd($id);
    }
}
