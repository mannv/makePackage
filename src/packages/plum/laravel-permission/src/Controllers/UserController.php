<?php

namespace Plum\LaravelPermission\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Plum\LaravelPermission\Models\User;

class UserController extends BaseController
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->getAll();
        return view('plum::user.index', ['users' => $users]);
    }
}
