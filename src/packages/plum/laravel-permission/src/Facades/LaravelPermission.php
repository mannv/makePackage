<?php

namespace Plum\LaravelPermission\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelPermission extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-permission';
    }
}
