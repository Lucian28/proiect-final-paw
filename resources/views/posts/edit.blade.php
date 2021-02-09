@extends('layouts.app')

@section('content')
  <h1> Editeaza postarea ta  </h1>
  <hr>
  {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $continut->id], 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
  <div class="form-group">
      {{Form::label('titlu','Titlu')}}
      {{Form::text('titlu',$continut->titlu,['class'=>'form-control', 'placeholder'=>'Titlu'])}}
  </div>
   <div class="form-group">
    {{Form::label('descriere','Descriere')}}
   
    {{-- {{Form::textarea('descriere','',['id'=>'summary-ckeditor','name'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Descriere'])}} --}}
    {{-- {{Form::textarea('descriere','',['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Descriere'])}} --}}
    <textarea class="form-control" id="descriere" name="descriere"  >
        <?php echo htmlspecialchars($continut->descriere); ?>
    </textarea>
</div> 
<p> Categoria postarii: {{$categorii[0]->nume}} </p>

<div class="form-group">
    <label> Alege categoria </label>
    <select id="categorie" name="categorie">
        <option value=1>PHP</option>
        <option value=2>Java</option>
        <option value=3>Android</option>
        <option value=4>iOS</option>
        </select> 
    </div>
         <hr>
<div class="form-group">
    {{Form::file('cover_image')}}
    </div>
{{Form::hidden('_method','PUT')}}
{{Form::submit('Submit',['class'=>'btn btn-primary'])}}
      {!! Form::close() !!}
      <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'descriere' );
</script>
@endsection