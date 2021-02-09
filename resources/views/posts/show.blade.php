@extends('layouts.app')

@section('content')

<a href="/posts" class="btn btn-primary"> Inapoi </a>
<hr>
<label> Categoria postarii </label>
<p>@foreach ($categorii as $item)  </p>

  @if($item->id==$continut->idCategorie)
<div> {{$item->nume}} </div>
@endif
@endforeach

<hr>
  <h1> {{$continut->titlu}} </h1>
  <img style="width:20%" src="/storage/cover_images/{{$continut->cover_image}}">
  <hr>
<div>
  {!!$continut->descriere!!}
</div>
<hr>
@foreach($users as $users)
@if($users->id==$continut->idUtilizator)
 <small hidden="true"> {{$ut=$users->UserName}} </small>
@endif
@endforeach
<small> Postat la {{$continut->created_at}} de catre   {{$ut}} </small>
<hr>
@if(!Auth::guest())
@if(Auth::user()->id == $continut->idUtilizator)
<a href="/posts/{{$continut->id}}/edit" class="btn btn-warning"> Edit </a>

{!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $continut->id],'method'=>'POST', 'class' =>'pull-right'])  !!}
{{Form::hidden('_method','DELETE')}}

{{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
{!!Form::close()!!}
@endif
@endif

<hr>
<div>
{{-- @comments(['model' => $continut]) --}}

@comments([
    'model' => $continut   
])
</div>


@endsection