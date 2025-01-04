<?php

use App\Http\Controllers\User\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('roles', [RoleController::class, 'index']);
Route::get('roles/{role}', [RoleController::class, 'show']);
