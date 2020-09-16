<?php

use Illuminate\Support\Facades\Route;

$prefixUrl = config('laravel-permission.prefix.url');
$prefixName = config('laravel-permission.prefix.name');

Route::group([
    'middleware' => ['web']
], function ($route) use ($prefixUrl, $prefixName) {
    $route->get($prefixUrl . '/user', 'Plum\LaravelPermission\Controllers\UserController@index')->name($prefixName . 'user.index');
    $route->name($prefixName)->group(function ($route) use ($prefixUrl) {
        $route->resource($prefixUrl . '/role', 'Plum\LaravelPermission\Controllers\RoleController')
            ->except(['destroy'])
            ->parameters(['role' => 'id']);
    });
});
