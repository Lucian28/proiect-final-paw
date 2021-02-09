@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading " style="font-size: 24px"> Dashboard </div>


                <div class="panel-body">
                    <a href="/posts/create" class="btn btn-primary"> Creeaza o postare </a>
                    <h3> Postarile mele </h3>
                    @if(count($continut) >0)
                    <table class="table table-striped">
                        <tr>
                            <th> Titlu </th>
                            <th>       </th>
                            <th>       </th>
                        </tr>
                        @foreach($continut as $continut)
                        <tr>
                            <td> <a href="/posts/{{$continut->id}}" > {{$continut->titlu}} </a></td>
                            <td>  <a href="/posts/{{$continut->id}}/edit" class="btn btn-warning">Editeaza</a>     </td>
                            <td> 
                                {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $continut->id],'method'=>'POST', 'class' =>'pull-right'])  !!}
                                {{Form::hidden('_method','DELETE')}}
                                
                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                {!!Form::close()!!}    
                            </td>
                        </tr>
                        @endforeach
                    </table>
                 
                    {{-- @foreach ($com as $item)
                       
                       <p> {{$item->titlu}}
                    @endforeach
                    <p> Comentarii postate : {{$i}}</p>
                  --}}
                    @else
                     <p> Nu exista postari create </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection