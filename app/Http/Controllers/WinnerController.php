<?php

namespace App\Http\Controllers;

use App\Jobs\SaveUsers;
use App\Models\Data;
use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function index()
    {
        $users = Data::get();
        return view('createOffer',compact('users'));
    }

    public function save(Request $request){

        dispatch(new SaveUsers($request->all()));
        
        return 'succes';

    }
}
