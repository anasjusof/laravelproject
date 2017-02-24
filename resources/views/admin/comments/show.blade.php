@extends('layouts.admin')


@section('content')
    @if(Session::has('deleted_user'))
      <!-- <p style="color:grey;" class="bg-danger text-center">{{session('deleted_user')}}</p> -->
      <script>alert("{{session('deleted_user')}}");</script>
    @endif

    @if($comments)
    <h1 class="text-center">Comments</h1>

    <table class="table table-bordered">
	    <thead>
	      <tr>
	        <th>No.</th>
	        <th>Post Title</th>
	        <th></th>
	        <th>Author</th>
	        <th>Body</th>
	        <th>Created</th>
	        <th>Updated</th>
	        <th></th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php $count = 1; ?>
	      @if($comments)
	      @foreach($comments as $comment)
	      <tr>
	        <td>{{$count}}</td>
	        <td><a href="{{route('home.post', $comment->post->id)}}">{{$comment->post->title}}</a></td>
	        <td><a href="{{route('admin.comments.replies.show', $comment->id)}}">View replies</a></td>
	        <td>{{$comment->author}}</td>
	        <td>{{$comment->body}}</td>
	        <td>{{$comment->created_at->diffForHumans()}}</td>
	        <td>{{$comment->updated_at->diffForHumans()}}</td>
	        <td>
	        	@if($comment->is_active == 1)
	        		{!! Form::model($comment, ['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id], 'files'=>true]) !!}
	        			<input type="hidden" name="is_active" value="0">
	        			{!! Form::submit('Disable comment', ['class'=>'btn btn-warning']) !!}

	        		{!! Form::close() !!}
	        	@else
	        		{!! Form::model($comment, ['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id], 'files'=>true]) !!}
	        			<input type="hidden" name="is_active" value="1">
	        			{!! Form::submit('Approve comment', ['class'=>'btn btn-info']) !!}

	        		{!! Form::close() !!}
	        	@endif
	        	
	        </td>
	        <td>
        		{!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id] ]) !!}

				    <div class="form-group col-md-6">
				        {!! Form::submit('Delete Comment', ['class'=>'btn btn-danger']) !!}
				    </div>

	    		{!! Form::close() !!}
	        </td>
	      </tr>
	      <?php $count++ ?>
	      @endforeach
	      @endif
	    </tbody>
	  </table>
	  @else
	  <h1 class="text-center">No Comments Available</h1>
	  @endif

@stop