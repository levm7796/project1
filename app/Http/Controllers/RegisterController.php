<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class RegisterController extends Controller
{
    public static function store(Request $req) {
        try {

            $req->validate([
                "name"=>"required",
                "email"=>"required",
                "password"=>"required"
            ]);

            $credentials = $req->only('email', 'password');

            if(Auth::attempt($credentials)) {
                return array(
                    'error'=>'This token already exist\'s'
                );
            }

            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = $req->password;
            $user->save();

            return 'ok';

        } catch (Exception $e) {

        return array(
            'error'=>$e->getMessage()
        );

        }
    }
}
