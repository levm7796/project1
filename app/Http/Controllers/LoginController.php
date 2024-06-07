<?php

namespace App\Http\Controllers;

use App\Mail\Mail\PasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use function Egulias\EmailValidator\Validation\withError;
use function Laravel\Prompts\table;

class LoginController extends Controller
{
    public static function store(Request $req) {
        try {
            $req->validate([
                "email"=>"required",
                "password"=>"required",
            ]);


            $credentials = $req->only('email', 'password');

            if(Auth::attempt($credentials)) {
                $req->session()->regenerate();
                $user = Auth::user();
                $token = $user->createToken('token')->plainTextToken;
                cookie('jwt', $token, 60*24);
                return array(
                    'token' => $token
                );
            }
            return array(
                'error' => 'Wrong login or password'
            );
        } catch (\Exception $error) {
            return array(
                'error' => 'Wrong login or password'
            );
        }
    }

    public function setRegion(Request $request) {
        $email = $request->input('email');
        $region = $request->input('region');

        DB::table('users')->where('email', $email)->update(array('region'=>$region));
    }

    public function changePassword(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $newPassword = $request->input('newPassword');

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
                auth()->user()->password = bcrypt($newPassword);
                auth()->user()->update();
                return 'ok';
        } else {
            return array('error' => 'Wrong password');
        }

    }

    public function setToken(Request $request) {
        $email = $request->input('email');

        $results = DB::table('users')->select('id')->where('email', $email)->get();
        if($results == '[]') {
            return array(
                'error' => 'User with this email don\'t exist'
            );
        }

        $token = bin2hex(random_bytes(8));
        $results2 = DB::table('password_reset_tokens')->select('token')->where('email', $email)->get();
        if ($results2 == '[]') {
            DB::insert('insert into password_reset_tokens (email, token) values (?, ?)', [$email, '$token']);
        } else {
            DB::table('password_reset_tokens')->where('email', $email)->update(array('token'=>$token));
        }
//        try{
//            DB::insert('insert into password_reset_tokens (email, token) values (?, ?)', [$email, '$token']);
//        } finally {
//        DB::table('password_reset_tokens')->where('email', $email)->update(array('token'=>$token));
//        }
        Mail::to($email)->send(new PasswordMail($email, $token));
        return 'ok';
    }

    public function forgotPassword(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('token');

        $result = DB::table('password_reset_tokens')->select('token')->where('email', $email)->where('token', $token)->get();
        if(count($result) < 1) {
            return false;
        }

        $password2 = DB::table('users')->select('password')->where('email', $email)->get();
        $password2 = $password2[0]->password;
        $password2 = Crypt::encrypt($password2);
//        $credentials = $request->only('email');
//        return $credentials;
//        if(Auth::attempt(array('email' => $email, 'password'=>$password2))) {
//            auth()->user()->password = bcrypt($password);
//            auth()->user()->update();
//            return 'ok';
//        }
        User::where('email', $email)->update(['password'=>bcrypt($password)]);
        return 'ok';

    }
}
