<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use Image;
use DB;
use App\Models\User;
class PagesController extends Controller
{
    //
    public function index(){
        $title='Welcome to Laravel!';
        // return view('pages.index',compact('title'));
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        $com=DB::table('comments')->get();
        $com2=DB::table('comments')->where('commenter_id',Auth::id())->get();
        $user = Auth::user();
        $continut= Post::orderBy('created_at','desc')->get();
        $ratings=DB::table('ratings')->get();
        return view('pages.about')->with('comments',$com)->with('user',$user)->with('continut',$continut)->with('ratings',$ratings);//->with('comments',$com2);
    }

    public function services(){
       
    return view('pages.services');
    }

    public function profil(){
        return view('profil', array('user' => Auth::user()));
         }

         public function update_imagine(Request $request){
           if($request->hasFile('imagine')){
               $imagine=$request->file('imagine');
               $filename=time() . '.' . $imagine->getClientOriginalExtension();
               Image::make($imagine)->resize(300,300)->save(public_path('/imagini/'.$filename));
               $user = Auth::user();
               $user->imagine = $filename;
               $user->save();
            }
            return view('profil', array('user' =>Auth::user()));
             }
}
 