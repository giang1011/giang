<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserController extends Controller
{
    public function index()
    {
        $users = User::join('user_roles', 'users.id', '=', 'user_roles.user_id')
                     ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                     ->select('users.id', 'users.username', 'users.created_at', 'roles.role_name')
                     ->get();

        return response()->json($users);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}