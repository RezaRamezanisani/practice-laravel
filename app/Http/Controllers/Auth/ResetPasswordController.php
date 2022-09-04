<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MyTestEmail;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function resetPasswordView($token)
    {
        return view('auth.reset-password',['token'=>$token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email_phone',
            'password'=>'required|regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}/',
            'confirm'=>'required|same:password'
        ]);
        $find_token_email = DB::table('reset_password')->where(['email'=>$request->email,'token'=>$request->token])->first();
        if($find_token_email){
            //find for is id note to method  update!
            User::where('email_phone',$request->email)->update(['password'=>Hash::make($request->password)]);;
            DB::table('reset_password')->where('email',$request->email)->delete();
            return redirect()->route('login.view')->with('password-reset','our password has been changed');
        }else{
            return back()->with('invalid token','invalid token');
        }

    }
}
