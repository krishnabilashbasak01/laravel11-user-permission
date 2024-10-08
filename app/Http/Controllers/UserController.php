<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // create user
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6",
        ]);

        if ($validator->fails()) {
            return response(
                [
                    "status" => "error",
                    "message" => "Validation failed",
                    "errors" => $validator->errors(),
                ],
                422
            );
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response([
            'status' => 'success',
            'message' => "User created successfully"
        ], 200);
    }

    // edit user

    // delete user
    public function deleteUser($id){
        $user = User::find($id);

        $user->delete();

        return response([
            'status' => 'success',
            'message' => "User deleted successfully"
        ], 200);
    }

    // get users
    public function getAllUsers()
    {
        $users = User::with('roles')->get();

        return response([
            'status' => 'success',
            'message' => "Users found successfully",
            'users' => $users
        ], 200);
    }

    // get user by id
    public function getUser($id)
    {
        $user = User::with('roles')->find($id);

        return response([
            'status' => 'success',
            'message' => "User found successfully",
            'user' => $user
        ]);
    }
}