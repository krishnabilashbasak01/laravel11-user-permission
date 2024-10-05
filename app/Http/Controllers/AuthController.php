<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login 
    public function login(Request $request){

        if (!empty(Auth::check())) {
            return redirect("admin/dashboard");
        }

        if ($request->isMethod("post")) {
            $credentials = $request->only("email", "password");
            $remember = $request->has("remember");

            if (Auth::attempt($credentials, $remember)) {
                return redirect("admin/dashboard");
            } else {
                return redirect("admin/login")->with(
                    "error_message",
                    "Invalid Email or Password!"
                );
            }
        }
        return view("admin.login");
    }

    // Dashboard
    public function index(){

        return view('admin.dashboard');
    }


    // Logout
    public function logout(){
        Auth::logout();
        return redirect("admin/login");
    }

}
