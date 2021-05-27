<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{

    public function assignRoleToUser(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        $user = User::find($user_id);
        $role = Role::find($role_id);
        if ($user && $role){
            UserRole::updateOrCreate(['user_id' => $user_id, 'role_id' => $role_id], []);
            return response(['message' => 'Role successfully assign to ' . $user->firstName . ' ' . $user->lastName], 200);
        }else{
            return response(['message' => 'Failed! Invalid user/role'], 400);
        }
    }
    public function deleteAssignRole($user_id, $role_id)
    {
        $role = UserRole::where(['user_id' => $user_id, 'role_id' => $role_id])->first();
        if ($role){
            $role->delete();
            return response(['message' => 'Role successfully delete.'], 200);
        }else{
            return response(['message' => 'Failed! Role already deleted'], 400);
        }
    }
    public function getRolesByUser($id)
    {
        $user = User::find($id);
        if ($user){
            $roles = UserRole::select('roles.name', 'roles.description', 'user_roles.role_id')
            ->join('roles', 'roles.id', '=', 'user_roles.role_id')
            ->where('user_id', $id)->get();
//            dd($roles);
            return response(['message' => 'Successful', 'roles' => $roles], 200);
        }else{
            return response(['message' => 'User not found!'], 400);
        }
    }
    public function checkAssignRole($user_id, $role_id)
    {
        $role = UserRole::where(['user_id' => $user_id, 'role_id' => $role_id])->first();
        return ($role) ? response(['check' => 'yes'], 200) : response(['check' => 'no'], 200);
    }

    public function getSingleUserRoles($uid) {
        $roles = UserRole::select('role_id')
                ->where('user_id', $uid)
                ->get();
        return response(['message' => 'Successful', 'roles' => $roles], 200);
    }
    public function saveUserEditRole(Request $request)
    {
        $user_id = $request->user_id;
        $input_roles = $request->roles;
        foreach ($input_roles as $value){
            $role = UserRole::where(['user_id' => $user_id, 'role_id' => $value])->first();
            if (!$role){
                UserRole::create(['user_id' => $user_id, 'role_id' => $value]);
            }
        }
        UserRole::whereNotIn('role_id', $input_roles)->where('user_id', $user_id)->delete();
        return response(['message' => 'Successful', 'success' => true], 200);
    }
}
