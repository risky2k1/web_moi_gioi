<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();
//        dd($user);
        $user = User::updateOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getName(),
            'avatar' => $user->getAvatar(),
        ]);
        Auth::login($user);
        return redirect()->route('register');
    }

    public function registering(Request $request)
    {
        $password = Hash::make($request->password);
        if(auth()->check()){
            User::where('id', auth()->user()->id)
                ->update([
                    'password'=>$password,
                ]);
        }else{
            $user = User::create([
                'name'=> $request->name ,
                'email'=> $request->email,
                'password'=> $password,
            ]);
            if (!empty($user)) {
                Auth::login($user);
            }
        }
    }
}
