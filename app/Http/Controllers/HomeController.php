<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Mail\testemail;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Data;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendMails;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = post::with(['comments' => function($q){
            $q -> select('id','post_id','comment');
        }])->get();
        return view('home',compact('posts'));
    }

    public function  saveComment(Request $request){
        Comment::create([
               'post_id' => $request -> post_id ,
               'user_id' => auth()->user()->id,
               'comment' => $request -> post_content,
        ]);

        $data =[
            'user_id' => auth()->user()->id,
            'user_name'  =>  auth()->user()->name,
            'comment' => $request -> post_content,
            'post_id' =>$request -> post_id ,
            'date' => date("Y-m-d", strtotime(Carbon::now())),
            'time' => date("h:i A", strtotime(Carbon::now())),
       ];

        

        event(new NewNotification($data));
        return redirect()->back()->with(['success'=>'تمت اضافة تعليق بنجاح']);
    }

    public function send_email(){

        $emails =  Data::chunk(5 ,function ($data){
            dispatch(new SendMails($data));
    });
      
        return 'تم';
    }
}
