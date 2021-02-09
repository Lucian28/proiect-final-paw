@extends('layouts.app')

@section('content')


<h4> Selecteaza o categorie </h4>
@foreach ($categorii as $item) 
<form action="/" method="POST" > 
    @csrf
<li> <button> {{$item->nume}} </button> </li>
</form>
@endforeach
@foreach ($categorii as $item) 
@if(isset($_POST[$item->nume]))
{{$IDUL=$item->id}}
@endforeach

  <h1> Postari </h1>
  @if(count($continut) > 0)
  @if($categorii->id==$post->idCategorie)
    @foreach($continut as $post)
      @if($IDUL==$post->idCategorie)
    <div class="card p-3 mt-3 mb-3">
        <div class="row">
          <div class="col-md-4 col-sm-4"  style="background: rgb(10, 13, 24); text-align:center">
              <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}">
          </div>
          <div class="col-md-8 col-sm-8">
            <h3><a href="/posts/{{$post->id}}"> {{$post->titlu}}</a></h3>
            <small> Postat la {{$post->created_at}}  </small>
          
          </div>
      </div>
       
    </div>
    @endif
       @endforeach
   @endif
       {{$continut->links('pagination::bootstrap-4')}}
       
  @else
  <p> Nu exista postari </p>
  @endif
@endsection