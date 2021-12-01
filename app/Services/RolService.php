<?php

namespace App\Services;
use App\Models\User;
use App\Constantes\Auth as AuthConst;

class RolService
{
    public static function verifyIsAdmin($userId){
        $user = User::find($userId);
        if($user->rol_id == AuthConst::ADMIN_ROL_ID){
            return true;
        }
        return false;
    }

    public static function verifyIsUserNoAdmin($userId){
        $user = User::find($userId);
        if($user->rol_id == AuthConst::USER_ROL_ID){
            return true;
        }
        return false;
    }
}
