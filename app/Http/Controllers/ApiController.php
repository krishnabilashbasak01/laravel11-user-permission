<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return response([
            'status' => 'success',
            'data' => $users
        ], 200);
    }
}
