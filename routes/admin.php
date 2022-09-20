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
    Route::resources([
        'event' => EventController::class,
        'role' => RoleController::class,
        'user' => UserController::class,
        'section' => SectionController::class,
        'permission' => PermissionController::class
    ]);
});
