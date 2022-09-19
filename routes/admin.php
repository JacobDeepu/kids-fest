<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('section', SectionController::class);
    Route::resource('event', EventController::class);
});
