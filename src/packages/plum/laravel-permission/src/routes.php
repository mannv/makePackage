<?php

use Illuminate\Support\Facades\Route;

$prefixUrl = config('laravel-permission.prefix.url');
$prefixName = config('laravel-permission.prefix.name');

Route::get($prefixUrl . '/admin', 'Plum\LaravelPermission\Controllers\UserController@index')->name($prefixName . 'user.index');
