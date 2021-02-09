<?php $x=0;
    $copie=$continut;
    $contor=0;
    $maiexista=false; 
    $com2=$comments;
    $r=$ratings;
    
    ?>

@extends('layouts.app')

@section('content')


<h1> Comentariile tale </h1>

@foreach ($comments as $comments)
<?php $contor=0;?> 
@if ( $comments->commenter_id==$user->id )
    @foreach($copie as $continut)
    @if($comments->commentable_id==$continut->id)
    <div class="card p-4 mt-4 mb-4">
<a href="/posts/{{$continut->id}}" style="color: red"> Vezi postarea {{$continut->titlu}} </a>
<?php $maiexista=true; ?>
<?php $x++; ?>
@endif 
@endforeach
  @if($maiexista==true)
 <p> Comentariu : {{$comments->comment}} </p>
 <small> {{$comments->created_at}} </small>
</div>

@endif
@endif
@endforeach
@if ($x==0)
<h3> Nu ai nici un comentariu </h3>
@elseif($x==1)
<h3> Ai postat <?php echo $x;?> comentariu </h3>
@elseif($x>1)
<h3>  <?php echo $x;?> comentarii postate de tine </h3>
@endif
{{-- @if($x>0)
<h3> Cel mai votat comentariu </h3>
<?php for ($i=0; $i < 100; $i++) 
    $a[$i]=0; ?>
@foreach($ratings as $ratings)
<?php $a[$ratings->rateable_id]++; ?>
@endforeach
<?php $max=0; $indice=0;
for ($i=0; $i < 100; $i++) 
 if($a[$i]>$max){
   $max=$a[$i];
   $indice=$i;
   
 }
?>
@foreach ($com2 as $com2)
@if($indice == $com2->id)
<h3> {{ $max }}<br></h3>

@endif
@endforeach


@endif --}}
@endsection
