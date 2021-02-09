<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Continut;
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
        $user_id =auth()->user()->id;
        $user = User::find($user_id);
        $continut=User::all();
      
        $com=DB::table('comments')->get();
        return view('dashboard')->with('user',$user)->with('continut',$continut)->with('comments',$com);
    }

   
}