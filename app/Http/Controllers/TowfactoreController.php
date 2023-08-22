<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TowfactoreController extends Controller
{
    public function index(){
        return view('auth.test_verfiy');
    }

    public function store(Request $request){
        $user =auth()->user();
        if($request->input('code') == $user->code){

            $user->resetCode();
            return redirect()->route('dashboard');
        }

        return 'dd';
        return redirect()->back()->withErrors(['error'=>'error no code']);
    }
}
