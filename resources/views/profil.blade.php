{{-- 

@extends('layouts.app')


@section('content')
<div class="container">
     <div class="row">
          <div class="col-md-10 col-md-offset-1">
               <img src="/imagini/{{$user->imagine}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px">
                <h2> Profilul lui {{$user->UserName}} </h2>
               
               </div>
     </div>
</div>
<br>
<div style="padding-left:50px;">
<h3> Nume de utilizator: {{$user->UserName}}</h3> 
<h3> Nume: {{$user->Nume}}</h3>
<h3> Prenume: {{$user->Prenume}}</h3> 
<h3> email: {{$user->email}}</h3>

{!!Form::open(['action' => ['App\Http\Controllers\UserController@update_imagine'],'method'=>'POST','enctype'=>'multipart/form-data'])  !!}
                    
<input type="file" name="imagine">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                 
{{Form::label('Nume_Utilizatoree','Nume Utilizator')}}
{{Form::text('Nume_utilizator',$user->UserName,['class'=>'form-control','placeholder'=>$user->UserName])}}
{{Form::label('Numeee','Nume')}}
{{Form::text('Nume',$user->Nume,['class'=>'form-control', 'placeholder'=>$user->Nume])}}
{{Form::label('Prenumeee','Prenume')}}
{{Form::text('Prenume',$user->Prenume,['class'=>'form-control', 'placeholder'=>$user->Prenume])}}
{{Form::label('Emailee','Email')}}
{{Form::text('email',$user->email,['class'=>'form-control', 'placeholder'=>$user->email])}}

<hr>
{{Form::hidden('_method','POST')}}
{{Form::submit('Editeaza profil', ['class'=>'btn btn-danger'])}}
{!!Form::close()!!}    
<hr>
</div>

@endsection  --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="/imagini/{{$user->imagine}}" style="width:150px; height:150px; float:left;  margin-right:25px">
            <h2> Profilui lui {{ $user->UserName}}</h2>
            {{-- <form enctype="multipart/form-data" action="/profile" method="POST">
            <label>Update profil</label>
                  <input type="file" name="imagine">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 
            </form>  --}}
    
            {!! Form::open(['action' => ['App\Http\Controllers\UserController@edit_profil'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <label >Modificare profil</label>
            <input type="file" name="imagine">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <br><br><br><br>
            <div class="form-group" style="color: rgb(1, 58, 85); font-size: 20px;">
                
                {{Form::label('UserName', 'Nume de utilizator')}}
                {{Form::text('Nume_utilizator', $user->UserName, ['class' => 'form-control', 'placeholder' => 'UserName'])}}
            </div>  
            <div class="form-group" style="color: rgb(1, 58, 85); font-size: 20px;">
               {{Form::label('Nume', 'Nume')}}
               {{Form::text('Nume', $user->Nume, ['class' => 'form-control', 'placeholder' => 'Nume'])}}
           </div> 
           <div class="form-group" style="color: rgb(1, 58, 85); font-size: 20px;">
            {{Form::label('Prenume', 'Prenume')}}
            {{Form::text('Prenume', $user->Prenume, ['class' => 'form-control', 'placeholder' => 'Prenume'])}}
        </div> <div class="form-group" style="color: rgb(1, 58, 85); font-size: 20px;">
            {{Form::label('email', 'Adresa de email')}}
            {{Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'email'])}}
        </div> 
           {{Form::hidden('_method','POST')}}
           {{Form::submit('Salveaza modificari', ['class'=>'btn btn-warning'])}} 
       {!! Form::close() !!}
        </div>
    </div>
</div>


@endsection
