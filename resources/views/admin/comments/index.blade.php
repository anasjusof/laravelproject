@extends('layouts.admin')


@section('content')
    @if(Session::has('deleted_user'))
      <!-- <p style="color:grey;" class="bg-danger text-center">{{session('deleted_user')}}</p> -->
      <script>alert("{{session('deleted_user')}}");</script>
    @endif

    <h1>Comments</h1>

    <table class="table table-bordered">
	    <thead>
	      <tr>
	        <th>No.</th>
	        <th>Post Title</th>
	        <th>Author</th>
	        <th>Body</th>
	        <th>Created</th>
	        <th>Updated</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php $count = 1; ?>
	      @if($comments)
	      @foreach($comments as $comment)
	      <tr>
	        <td>{{$count}}</td>
	        <td><a href="{{route('home.post', $comment->post->id)}}">{{$comment->post->title}}</a></td>
	        <td>{{$comment->author}}</td>
	        <td>{{$comment->body}}</td>
	        <td>{{$comment->created_at->diffForHumans()}}</td>
	        <td>{{$comment->updated_at->diffForHumans()}}</td>
	      </tr>
	      <?php $count++ ?>
	      @endforeach
	      @endif
	    </tbody>
	  </table>

@stop