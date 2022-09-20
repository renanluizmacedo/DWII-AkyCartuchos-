<?php

namespace App\Facades;

use App\Models\Permission;

class UserPermissions
{

    public static function loadPermissions($user_type)
    {

        $sess = array();
        $perm = Permission::with(['resource'])->where('role_id', $user_type)->get();

        foreach ($perm as $item) {

            $sess[$item->resource->name] = (bool) $item->permissao;
        }


        session(['user_permissions' => $sess]);

    }

    public static function isAuthorized($rule)
    {

        $permissions = session('user_permissions');

        return $permissions[$rule];
    }

    public static function listEmployee($user)
    {
        if($user->role->name == 'ADMINISTRADOR'){
            return false;
        }

        return true;
    }
    public static function hasPrivileges()
    {
        $permissions = session('user_permissions');

        foreach($permissions as $perm){
            if($perm == false){
                return false;
            }
        }
        return true;
    }
}
