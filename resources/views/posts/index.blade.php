@extends('layouts.appindex')


@section('content')
<div style="background-color:rgb(38, 38, 49); width:250px; ">
<a class="nav-link "  href="/posts/create" style="color:rgb(255, 255, 255);   text-align:center; font-size:28px"> <b> Creeaza o postare </b></a></li>

</div>
<hr>

<h2 style="color:rgb(13, 38, 63) "> <b> Selecteaza categoriile dorite </b></h2> 

{!! Form::open(['action' => 'App\Http\Controllers\PostsController@index', 'method'=>'POST',]) !!}

<br>

 
@foreach ($categorii as $item) 

{{Form::checkbox($item->nume, $item->id, false)}}
<b style="color: brown; font-size:24px">

{{Form::label($item->id,$item->nume)}}
</b>

&emsp;
@endforeach


<br><br>
{{Form::submit('Afiseaza rezultatele',['class'=>'btn btn-primary'])}} 
{!! Form::close() !!}
<hr>


      
  @if(count($continut) > 0)
    @foreach($continut as $post)

    <div class="card p-4 mt-4 mb-4">
        <div class="row">
          <div class="col-md-4 col-sm-4"  style="background: rgb(10, 13, 24); text-align:center">
              <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
          </div>
          <div class="col-md-8 col-sm-8">
            <h3><a href="/posts/{{$post->id}}" style="color: red"> {{$post->titlu}}</a></h3>
            <small style="color: rgb(11, 49, 49)"> Postat la {{$post->created_at}}  </small>
            <p>@foreach ($categorii as $item)  </p>

  @if($item->id==$post->idCategorie)
<div style="color: rgb(53, 48, 0)"> {{$item->nume}} </div>
@endif
@endforeach
          </div>
      </div>
       
    </div>
       @endforeach
   
       {{$continut->links('pagination::bootstrap-4')}}
  @else
  <p> Nu exista postari </p>
  @endif
@endsection