<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // get Roles
    public function roles() {
        $roles = Role::get();

        return response([
            'status' => 'success',
            'roles' => $roles
        ], 200);
    }

    // Create Roles
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:roles",
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

        Role::create(['name' => $request->name]);

        return response([
            'status' => 'success',
            'message' => "Role created successfully"
        ], 200);
    }

    // Update Roles
    public function update(Request $request, $id) {
        $role = Role::find($id);
        if (!$role) {
            return response(['error' => 'role not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:roles",
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

         // Update the role
         $role->name = $request->name;
         $role->save();


         return response([
            'status' => 'success',
            'message' => "Permission updated successfully"
        ], 200);
    }

    // Delete Roles
    public function delete($id) {
        $role = Role::find($id);
        $role->delete();
        
        return response([
            'status' => 'success',
            'message' => "Role deleted successfully"
        ], 200);
    
    }


    // Get permission
    public function permissions($id) {
        $role = Role::find($id);
        $permissions = $role->permissions;

        return response([
            'status' => 'success',
            'permissions' => $permissions
        ], 200);
    }

    // Add Permissions
    public function addPermissions(Request $request ,$roleId){
        $role = Role::find($roleId);
        $role->givePermissionTo($request->permission);

        return response([
            'status' => 'success',
            'message' => "Permission added successfully"
        ], 200);
    }

    // delete role permission
    public function deletePermission(Request $request, $roleId){
        $role = Role::find($roleId);
        $role->revokePermissionTo($request->permission);

        return response([
            'status' => 'success',
            'message' => "Permission removed successfully"
        ], 200);
    }

    // add role to user
    public function addUserRole(Request $request, $id){
        $user = User::find($id);

        $user->assignRole($request->role);

        return response([
            'status' => 'success',
            'message' => "Role Added successfully"
        ], 200);
    }

    // Remove role from user
    public function removeRole(Request $request, $userId){
        $user = User::find($userId);
        $user->removeRole($request->role);

        return response([
            'status' => 'success',
            'message' => "Role Removed successfully"
        ], 200);
    }
}
