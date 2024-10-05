<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Get Permissions
    public function permissions()  {
        $permissions = Permission::get();
        return response([
            'status' => 'success',
            'permissions' => $permissions
        ], 200);
    }

    // Create Permission
    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:permissions",
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

        Permission::create(['name' => $request->name]);

        return response([
            'status' => 'success',
            'message' => "Permission created successfully"
        ], 200);
    }

    // Update Permission
    public function update(Request $request, $id) {
        $permission = Permission::find($id);
        if (!$permission) {
            return response(['error' => 'Permission not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:permissions",
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

         // Update the permission
         $permission->name = $request->name;
         $permission->save();


         return response([
            'status' => 'success',
            'message' => "Permission updated successfully"
        ], 200);

    }

    // Delete Permission
    public function delete($id) {
        $permission = Permission::find($id);
        $permission->delete();
        
        return response([
            'status' => 'success',
            'message' => "Permission deleted successfully"
        ], 200);
    }
}
