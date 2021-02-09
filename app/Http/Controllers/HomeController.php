<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use App\Models\Post;
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
        // $idUtilizator=auth()->user()->id;
        // $UserName = User::find($idUtilizator);
        // return view('dashboard')->with('continut',$UserName->continut);


        $user_id= auth()->user()->id;
        $user = User::find($user_id);
        $continut=Post::all()->where('idUtilizator', $user_id);

        
        return view('dashboard')->with('user', $user)->with('continut', $continut);

    }

   
}
