<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Route::get('/', function () {
//     return view('welcome');
// });


Route::match(["get", "post"], '/', [AuthController::class, 'login']);

Route::prefix("/admin")->group(function () {
    Route::match(["get", "post"], "/login", [
        AuthController::class, 'login'
    ])->name("login");

    Route::group(["middleware" => "useradmin"], function () {
        Route::match(["get", "post"], "/dashboard", [
            AuthController::class,
            "index",
        ])->name("dashboard");



        Route::match(["get", "post"], "/users", [
            AuthController::class,
            "users"
        ]);







        // Logout
        Route::match(["get", "post"], "/logout", [
            AuthController::class,
            "logout",
        ])->name("dashboard");
    });
 
});
