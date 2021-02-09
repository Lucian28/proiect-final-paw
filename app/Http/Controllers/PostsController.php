<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use App\Models\Categorii;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use AppRating;
use Auth;
use App\Models\Rating;


class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $categorii = DB::table('categorii')->get();
        $cat1=0;$cat2=0;$cat3=0;$cat4=0;$i=1;
        foreach($categorii as $categori){
       $raspuns=$request->__isset($categori->nume);
       if($raspuns==1 && $i==1 )
        $cat1=1;
        if($raspuns==1 && $i==2 )
        $cat2=2;
        if($raspuns==1 && $i==3 )
        $cat3=3;
        if($raspuns==1 && $i==4 )
        $cat4=4;
        $raspuns=0;
        $i++;
      
    } 
       
    $categorii = DB::table('categorii')->get();
    if($cat1==1 ||  $cat2==2 || $cat3==3||$cat4==4 )
        $continut=Post::orderBy('created_at','desc')->where('idCategorie',$cat1)->orWhere('idCategorie',$cat2)->orWhere('idCategorie',$cat3)->orWhere('idCategorie',$cat4)->PAGINATE(5);
        else
        $continut= Post::orderBy('created_at','desc')->PAGINATE(5);
      
        return view('posts.index')->with('continut',$continut)->with('categorii',$categorii);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'titlu'=>'required',
            'descriere' => 'required',
            'cover_image' => 'image|nullable|max:1999'
            
        ]);
if($request->hasFile('cover_image')){
//Get filaname
$filenameWithExt=$request->file('cover_image')->getClientOriginalName();
// get just filename
$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
//get just extension
$extension=$request->file('cover_image')->getClientOriginalExtension();
// filename to store
$fileNameToStore=$filename.'_'.time().'.'.$extension;
// upload image
$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore );

} else{
    $fileNameToStore='noimage.jpg';
}


        $continut= new Post;
        $continut->titlu = $request->input('titlu');
        $continut->descriere=$request->input('descriere');
        $continut->idCategorie=$request->input('categorie');
        $continut->idUtilizator=auth()->user()->id;
        $continut->cover_image = $fileNameToStore;
        
        $continut->save();

        return redirect('/posts')->with('success', 'Postarea a fost creata');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $continut = Post::find($id);
        $categorii = DB::table('categorii')->get();
        $users = DB::table('users')->get();
        $ratings=DB::table('ratings')->where('user_id',Auth::id())->get();
        return view('posts.show')->with('continut',$continut)->with('categorii',$categorii)->with('users',$users)->with('ratings',$ratings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $continut = Post::find($id);
        $categorii = DB::table('categorii')->where('id',$continut->idCategorie)->get();//;
        
        //Verificarea utilizatorului corect
        if(auth()->user()->id !==$continut->idUtilizator){
            return redirect('/posts')->with('error','Acces interzis');
        }
        return view('posts.edit')->with('continut',$continut)->with('categorii',$categorii);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'titlu'=>'required',
            'descriere' => 'required'
        ]);

        if($request->hasFile('cover_image')){
            //Get filaname
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore );
            
            } 

        $continut= Post::find($id);
        $continut->titlu = $request->input('titlu');
        $continut->descriere=$request->input('descriere');
        $continut->idCategorie=$request->input('categorie');
        if($request->hasFile('cover_image')){
            $continut->cover_image = $fileNameToStore;
        }
        $continut->save();

        return redirect('/posts')->with('success', 'Continutul a fost Updatatat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $continut = Post::find($id);

        if(auth()->user()->id !==$continut->idUtilizator){
            return redirect('/posts')->with('error','Acces interzis');
        }

        if($continut->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$continut->cover_image);
        }
        $continut->Delete();
        return redirect('/dashboard')->with('success', 'Continutul a fost sters');
    }



    public function postStar (Request $request, $id) {
        $contor=0;
        $rating = new Rating;
        $rating->user_id = Auth::id();
        $iduser=0;
        $comentarii=DB::table('ratings')->where('user_id',Auth::id())->where('rateable_id',$id)->get();
        $comentarii_user=DB::table('comments')->where('id',$id)->get();
        foreach($comentarii_user as $comentarii_user)
        $iduser=$comentarii_user->commenter_id;
        foreach($comentarii as $comentarii)
         {
$contor++;

         }
         if($contor==0 && $iduser!=Auth::id()){
            
        $rating->rating = $request->input('star');
        $rating->rateable_id=$id;
        $rating->rateable_type="App\Models\Post";
        $rating->save();
         }
        return redirect()->back();
  }

//   public function up ($id) {
//     $continut = Post::find(1);
//     $categorii = DB::table('categorii')->get();
//     $users = DB::table('users')->get();
//     $com=DB::table('rating');
//     $com->valoareRating=($com->valoareRating)+1;
//     $com->id_comentariu=$id;
//     $com->save();
//     return view('posts.show')->with('continut',$continut)->with('categorii',$categorii)->with('users',$users);
//     // return redirect()->back();
// }


//   public function afisare ($id) {
//     $continut= Post::orderBy('created_at','desc')->PAGINATE(10);
//         $categorii = DB::table('categorii')->get($id);
        
//         return view('posts.categorii')->with('continut',$continut)->with('categorii',$categorii);
// }
public function search(Request $request){
    // Get the search value from the request
    $search = $request->input('search');
    $categorii = DB::table('categorii')->get();
    // Search in the title and body columns from the posts table
    $posts = Post::query()
        ->where('titlu', 'LIKE', "%{$search}%")
        ->orWhere('descriere', 'LIKE', "%{$search}%")
        ->get();


    // Return the search view with the resluts compacted
    return view('search', compact('posts'))->with('categorii',$categorii);
}


}
