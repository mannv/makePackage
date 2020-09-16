<?php

use Illuminate\Support\Facades\Route;

$prefixUrl = config('laravel-permission.prefix.url');
$prefixName = config('laravel-permission.prefix.name');

Route::get($prefixUrl . '/user', 'Plum\LaravelPermission\Controllers\UserController@index')->name($prefixName . 'user.index');
//Route::get($prefixUrl . '/role', 'Plum\LaravelPermission\Controllers\RoleController@index')->name($prefixName . 'role.index');
Route::name($prefixName)->group(function ($route) use ($prefixUrl) {
    $route->resource($prefixUrl . '/role', 'Plum\LaravelPermission\Controllers\RoleController')
        ->except(['destroy'])
        ->parameters(['role' => 'id']);
});
