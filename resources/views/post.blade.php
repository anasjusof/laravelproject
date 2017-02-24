@extends('layouts.blog-post')


@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'No file' }}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $post->body }}</p>
    <hr>

    <!-- Blog Comments -->

    @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
             
            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store', 'files'=>true]) !!}
            	<input type="hidden" name="post_id" value="{{$post->id}}">
            	<div class='form-group'>
    		        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
    		    </div>
            	
            	{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>

        <hr>

    @endif

    <!-- Posted Comments -->
    
    @if(count($post->comments) > 0)
        <?php $count = 1; ?>
        @foreach($post->comments as $comment)
            <!-- Comment -->
            @if($comment->is_active == 1)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" height="64" width="64" src="{{$comment->photo ? $comment->photo : 'http://placehold.it/64x64'}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">#{{$count}} {{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>

                        {{ $comment->body }}

                        @if(count($comment->replies) > 0)
                            <!-- Nested Comment -->
                            <?php $countReply = 1; ?>
                            @foreach($comment->replies as $reply)
                                @if($reply->is_active == 1)
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" height="64" width="64" src="{{$reply->photo ? $reply->photo : 'http://placehold.it/64x64'}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">#{{$countReply}} {{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        {{ $reply->body }}
                                    </div>
                                </div>
                                <?php $countReply++ ?>
                                @endif
                            @endforeach
                            <!-- End Nested Comment -->
                        @endif
                        <div class="media">
                            <!-- Start reply -->
                            @if(Auth::check())
                                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                    <div class="form-group">
                                        {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Reply', ['class'=>'btn btn-primary'])!!}
                                    </div>

                                {!! Form::close() !!}
                            @endif
                            <!-- End reply -->   
                        </div>
                    </div>
                </div>
                <?php $count++ ?>
            @endif
        @endforeach
    @endif


@stop