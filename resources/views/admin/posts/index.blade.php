@extends('layouts.admin')


@section('content')
	<h1>Posts</h1>

 <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo / Post</th>
        <th></th>
        <th>Posted by</th>
        <th>Category</th>
        <th>Title</th>
         <th>Body</th>
        <th>Created</th>
        <th>Updated</th>
      </tr>
    </thead>
    <tbody>
      @if($posts)
      @foreach($posts as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>
          <a href="{{route('home.post', $post->id)}}">
            <img height="80" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}">
          </a>
        </td>
        <td><a href="{{route('admin.comments.show', $post->id)}}">View comments</a></td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->category->name}}</td>
        <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
        <td>{{$post->body}}</td>
        <td>{{$post->created_at->diffForHumans()}}</td>
        <td>{{$post->updated_at->diffForHumans()}}</td>
      </tr>
      @endforeach
      @endif
    </tbody>
  </table>

@stop