{{-- @if($posts->isNotEmpty())
    @foreach ($posts as $post)
        <div class="post-list">
            <p>{{ $post->titlu }}</p>
            <img src="{{ $post->imagine }}">
        </div>
    @endforeach
@else 
    <div>
        <h2>No posts found</h2>
    </div>
@endif --}}




@extends('layouts.app')

@section('content')


<h4 style="color:slategray "> Selecteaza o categorie </h4>
{!! Form::open(['action' => 'App\Http\Controllers\PostsController@index', 'method'=>'POST',]) !!}

<br>
@foreach ($categorii as $item) 
{{-- <form action="/posts" method="POST" > 
<li> <button value="{{$item->id}}"> {{$item->nume}} </button> </li> 
</form> --}}


{{Form::label($item->id,$item->nume)}}

{{Form::checkbox($item->nume, $item->id, false)}}
<br>
@endforeach
{{Form::submit('Cauta',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}



  <h1> Postari </h1>

      
  @if(count($posts) > 0)
    @foreach($posts as $post)

    <div class="card p-3 mt-3 mb-3">
        <div class="row">
          <div class="col-md-4 col-sm-4"  style="background: rgb(10, 13, 24); text-align:center">
              <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
          </div>
          <div class="col-md-8 col-sm-8">
            <h3><a href="/posts/{{$post->id}}"> {{$post->titlu}}</a></h3>
            <small> Postat la {{$post->created_at}}  </small>
            <p>@foreach ($categorii as $item)  </p>

  @if($item->id==$post->idCategorie)
<div> {{$item->nume}} </div>
@endif
@endforeach
          </div>
      </div>
       
    </div>
       @endforeach
   
       {{-- {{$continut->links('pagination::bootstrap-4')}} --}}
  @else
  <p> Nu exista postari </p>
  @endif
@endsection