<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// User Api Route
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::post('/user', [UserController::class, 'createUser']);
Route::delete('/user/{id}', [UserController::class, 'deleteUser']);


// Permission api route
Route::get('/permissions', [PermissionController::class, 'permissions']);
Route::post('/permission/create', [PermissionController::class, 'create']);
Route::put('/permission/update/{id}', [PermissionController::class, 'update']);
Route::delete('/permission/delete/{id}', [PermissionController::class, 'delete']);

// Role Api route
Route::get('/roles', [RoleController::class, 'roles']);
Route::post('/role/create', [RoleController::class, 'create']);
Route::put('/role/update/{id}', [RoleController::class, 'update']);
Route::delete('/role/delete/{id}', [RoleController::class, 'delete']);
Route::get('/role/permissions/{id}', [RoleController::class, 'permissions']);
Route::post('/role/add-permission/{id}', [RoleController::class, 'addPermissions']);
Route::post('/role/remove-permission/{id}', [RoleController::class, 'deletePermission']);
Route::post('/role/add-user-role/{id}', [RoleController::class, 'addUserRole']);
Route::post('/role/remove-user-role/{id}', [RoleController::class, 'removeRole']);

