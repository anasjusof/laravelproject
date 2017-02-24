@extends('layouts.admin')


@section('content')
    @if(Session::has('deleted_user'))
      <!-- <p style="color:grey;" class="bg-danger text-center">{{session('deleted_user')}}</p> -->
      <script>alert("{{session('deleted_user')}}");</script>
    @endif

    @if($replies)
    <h1 class="text-center">Replies</h1>

    <table class="table table-bordered">
	    <thead>
	      <tr>
	        <th>No.</th>
	        <th>Comment Title</th>
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
	      @if($replies)
	      @foreach($replies as $reply)
	      <tr>
	        <td>{{$count}}</td>
	        <td>{{$reply->comment->body}}</td>
	        <td>{{$reply->author}}</td>
	        <td>{{$reply->body}}</td>
	        <td>{{$reply->created_at->diffForHumans()}}</td>
	        <td>{{$reply->updated_at->diffForHumans()}}</td>
	        <td>
	        	@if($reply->is_active == 1)
	        		{!! Form::model($reply, ['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id], 'files'=>true]) !!}
	        			<input type="hidden" name="is_active" value="0">
	        			{!! Form::submit('Disable reply', ['class'=>'btn btn-warning']) !!}

	        		{!! Form::close() !!}
	        	@else
	        		{!! Form::model($reply, ['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id], 'files'=>true]) !!}
	        			<input type="hidden" name="is_active" value="1">
	        			{!! Form::submit('Approve reply', ['class'=>'btn btn-info']) !!}

	        		{!! Form::close() !!}
	        	@endif
	        	
	        </td>
	        <td>
        		{!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id] ]) !!}

				    <div class="form-group col-md-6">
				        {!! Form::submit('Delete reply', ['class'=>'btn btn-danger']) !!}
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
	  <h1 class="text-center">No Reply Available</h1>
	  @endif

@stop