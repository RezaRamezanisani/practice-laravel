<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
//        return Str::lower($request->email);

        $request->validate([
            'email'=>'required|email|exists:users,email_phone',
        ]);
        $token = Str::random(60);
        $email = $request->email;
        DB::table('reset_password')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'create_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ]);

        Mail::to($request->email)->queue(new ResetPassword($token,$email));
        return back()->with('send email','for you sended email');
    }
}
