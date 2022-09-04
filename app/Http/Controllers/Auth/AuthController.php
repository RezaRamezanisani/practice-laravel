<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MyTestEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    public function signup(Request $request)
    {
        date_default_timezone_set('Asia/Tehran');
        $filed = $request->email_phone;
        if(is_numeric($filed)){
            $request->validate([
                'username'=> ['required','string','max:10','regex:/^[\w\d\s]+$/u'],
                'password'=>['required','string','regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}/u'],
                'password_confirm'=>['required','string','same:password'],
                'email_phone'=>['required','unique:users,email_phone','digits:11','numeric','regex:/[0]{1}[0-9]{10}/u'],
                //password_confirmed same:password
            ]);
        }else
        {
            $request->validate([
                'username'=> ['required','string','max:10','regex:/^[\w\d\s]+$/u'],
                'password'=>['required','string','regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}/u'],
                'password_confirm'=>['required','string','same:password'],
                'email_phone'=>['required','unique:users,email_phone','email'],
            ]);
        }
        $user = User::create([
            'username'=>           $request->username,
//            'username'=>           Str::lower($request->username),
            'password'=>           Hash::make($request->password),
            'email_phone'=>        $request->email_phone,
            'role_id'=>            2,
            'registered_at'=>      Carbon::now()->format('Y-m-d H-i-s'),
        ]);
        if($user){
            Mail::to($user->email_phone)->queue(new MyTestEmail($user));
            return redirect()->route('login.view')->with('msg','signup');
            //tips: اگر خود مدل را وارد Mail::to() کنیم خودش به صورت اتوماتیک email , name  را از مدل پیدا میکند
        }else{
            return back()->with('error','error');
        }
    }

    public function login(Request $request)
    {
        $filed = $request->email_phone;
        if(is_numeric($filed)){
            $request->validate([
                'password'=>['required','string','regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}/u'],
                'email_phone'=>['required','digits:11','numeric','regex:/[0]{1}[0-9]{10}/u'],
                //password_confirmed same:password
            ]);
        }else
        {
            $request->validate([
                'password'=>['required','string','regex:/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}/u'],
                'email_phone'=>['required','email'],
            ]);
        }

        $user  =$request->only('email_phone','password');
        $user['status']='active';
        $remember = $request->remember;
        if(Auth::attempt($user,$remember)){
            $request->session()->regenerate();
            return redirect()->intended('admin/panel');
            //Tip: intended یعنی اگر کاربد سعی داشته به ضفحه ی مورد نظری که با میدل ور محدود شده برود آن را به تور اتوماتیک میبرد به صفحه ی که کاربر نمی توانست وارد شود
        }else{
            return back()->with('msg','not find');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.view');

    }


}
