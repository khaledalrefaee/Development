<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SochialController extends Controller
{
    public function google(){
        return Socialite::driver('google')->redirect();
    }

    public function facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handelGoogel(){
        try {
            $user = Socialite::driver('google')->user();
            dd($user);
            $findUser = User::where('social_id', $user->id)->first();
    
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->route('dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google', // تم تصحيح الكلمة "googel" إلى "google"
                    'password' => Hash::make('kkkkk'),
                ]);
    
                Auth::login($newUser);
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage()); // تم تصحيح "$e->getMassege" إلى "$e->getMessage()"
        }
    }
}
