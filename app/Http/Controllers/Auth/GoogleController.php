<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
      try {
        $user = Socialite::driver('google')->user();
        $find_user = User::where('google_id',$user->id)->first();
        if($find_user){
            Auth::login($find_user);
            return redirect()->route('dashboard');
        }else{
            $new_user = User::create([
                'username'=>$user->name,
                'email_phone'=>$user->email,
                'google_id'=>$user->id,
                'password'=> Hash::make('123456Re'),
                'role_id'=>2,
                'status'=>'active'
            ]);
            Auth::login($new_user);
            return redirect()->route('dashboard');
        }
      }catch(Exception $e){
             return $e->getMessage();
      }
    }
}
