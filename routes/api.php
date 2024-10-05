<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [ApiController::class, 'index']);

Route::get('/permissions', [PermissionController::class, 'permissions']);
Route::post('/permission/create', [PermissionController::class, 'create']);
Route::put('/permission/update/{id}', [PermissionController::class, 'update']);
Route::delete('/permission/delete/{id}', [PermissionController::class, 'delete']);

