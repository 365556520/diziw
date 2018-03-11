<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class UserResetPasswordController extends Controller
{
    public function resetPas(){
        return view('auth.adminData.resretpas');
    }

}
