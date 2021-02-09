<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Auth;
use Image;

class UserController extends Controller
{
    public function profil(){

        return view('/profil', array('user' => Auth::user()));
    }

    public function edit_profil(Request $request){
        if($request->has('imagine')){
            $imagine = $request->file('imagine');
            $filename = time() . '.' . $imagine->getClientOriginalExtension();
            Image::make($imagine)->resize(300, 300)->save( public_path('/imagini/' . $filename));

            $user = Auth::user();
            $user->imagine = $filename;
            $user->save();
        }
        
        $user = Auth::user(); 
        $user->UserName=$request->input('Nume_utilizator');
        $user->Nume=$request->input('Nume');
        $user->Prenume=$request->input('Prenume');
        $user->email=$request->input('email');
        
       
       
        $user->save();
        return view('/profil', array('user' => Auth::user()));
    }

  
}



