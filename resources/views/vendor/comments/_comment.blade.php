@inject('markdown', 'Parsedown')
<head>
    {{-- <link href="{{ asset('css/rating.css') }}" rel="stylesheet"> --}}
    <style>

        </style>
</head>
@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
@endphp

<div id="comment-{{ $comment->getKey() }}" class="media">
   {{-- <img class="mr-3" src="https://www.gravatar.com/avatar/{{ md5($comment->commenter->email ?? $comment->guest_email) }}.jpg?s=64" alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar"> --}}
    @if($comment->guest_name)
    <img class="mr-3" src="/imagini/default.jpg" style="width: 50px">

@else
   <img class="mr-3" src="/imagini/{{$comment->commenter->imagine}}" style="width: 50px" alt="{{ $comment->commenter->UserName ?? $comment->guest_name }} Avatar">
   @endif 
 
   




        {{-- @endif --}}
   <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $comment->commenter->UserName ?? $comment->guest_name }} <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>
        <?php $suma=0;
        $nrvoturi=0; 
  $ratings=DB::table('ratings')->get();?>

@foreach($ratings as $ratings)
@if($comment->id == $ratings->rateable_id)
<?php $suma=$suma+$ratings->rating;
$nrvoturi++; ?>
@endif
@endforeach

<div> 
 <h5 style="color: rgb(0, 57, 212)"> Votat de  {{$nrvoturi}} ori </h5>
 @if($suma>0)
 <h5 style="color: rgb(0, 201, 33)"> Scor: {{$suma}} </h5>
 @else
 <h5 style="color: rgb(201, 0, 0)"> Scor: {{$suma}} </h5>
 @endif
</div>  
        <div style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div> 



        <div>
            @can('reply-to-comment', $comment)
                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.reply')</button>
            @endcan
            @can('edit-comment', $comment)
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}" class="btn btn-sm btn-link text-uppercase">@lang('comments::comments.edit')</button>
            @endcan
            @can('delete-comment', $comment)
                <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();" class="btn btn-sm btn-link text-danger text-uppercase">@lang('comments::comments.delete')</a>
                <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            @endcan
        </div>

        @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                            @method('PUT')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">@lang('comments::comments.update_your_message_here')</label>
                                    <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                    <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.update')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        @can('reply-to-comment', $comment)
            <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                                    <textarea required class="form-control" name="message" rows="3"></textarea>
                                    <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">@lang('comments::comments.cancel')</button>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <br />{{-- Margin bottom --}}

        <?php
            if (!isset($indentationLevel)) {
                $indentationLevel = 1;
            } else {
                $indentationLevel++;
            }
        ?>

        {{-- Recursion for children --}}
        @if($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
            {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
            @foreach($grouped_comments[$comment->getKey()] as $child)
                @include('comments::_comment', [
                    'comment' => $child,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif

    </div>
     <form class="form-horizontal poststars" action="{{route('postStar', $comment->id)}}" name="<?php echo $comment->id?>" value="<?php echo $comment->id?>" id="addStar<?php echo $comment->id?>" method="POST">
        {{ csrf_field() }}
              <div class="form-group required">
                
                <div class="col-sm-12">
                  <input class="star star-5" value="1" id="star-1" type="radio" name="star"/>
                  <label class="star star-5" for="star-5"> Upvote</label>
                  <input class="star star-4" value="-1" id="star-2" type="radio" name="star"/>
                  <label class="star star-4" for="star-4">Downvote</label>
                  {{-- <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
                  <label class="star star-3" for="star-3"></label>
                  <input class="star star-2" value="4" id="star-4" type="radio" name="star"/>
                  <label class="star star-2" for="star-2"></label>
                  <input class="star star-1" value="5" id="star-5" type="radio" name="star"/>
                  <label class="star star-1" for="star-1"></label> --}}
                 </div>
              </div>
      </form> 
      {{-- {!! Form::open(['action' => ['App\Http\Controllers\PostsController@up',$comment->id], 'method' => 'POST']) !!}
      <td>
        <span class="glyphicon glyphicon-arrow-up">  {{Form::submit('Upvote', ['class'=>'btn btn-primary btn-sm'])}} </span>
        {!!Form::close()!!}
      </td> 

 <button class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-arrow-down"></span> Downvote</button></td>
 --}}
</div>


<script>
    $('#addStar1').change('.star', function(e) {
    $(this).submit();
    });
</script>

<script>
    $('#addStar2').change('.star', function(e) {
    $(this).submit();
    });
</script>

<script>
    $('#addStar4').change('.star', function(e) {
    $(this).submit();
    });
</script>

<script>
    $('#addStar5').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar6').change('.star', function(e) {
    $(this).submit();
    });
</script>

<script>
    $('#addStar7').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar8').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar9').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar10').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar11').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar12').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar13').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar14').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar15').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar16').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar17').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar18').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar19').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar20').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar21').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar22').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar23').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar24').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar25').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar26').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar27').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar28').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar29').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar30').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar31').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar32').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar33').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar34').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar35').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar36').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar37').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar38').change('.star', function(e) {
    $(this).submit();
    });
</script>
<script>
    $('#addStar39').change('.star', function(e) {
    $(this).submit();
    });
</script> 
 {{-- for($i=1;$i<=1000;$i++) 
{
    
<script>
    $('#addStar'.$i).change('.star', function(e) {
    $(this).submit();
    });
</script>

}



{{-- Recursion for children --}}
@if($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
    {{-- TODO: Don't repeat code. Extract to a new file and include it. --}}
    @foreach($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments
        ])
    @endforeach
@endif