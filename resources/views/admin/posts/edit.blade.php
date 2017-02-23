@extends('layouts.admin')


@section('content')
<h1> Edit Post </h1>
	<div class="col-md-3">
		<img src="{{$post->photo->file}}" class="img-responsive">
	</div>
	<div class="col-md-9">
	    {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
	    <div class='form-group'>
	        {!! Form::label('title', 'Title : ') !!}
	        {!! Form::text('title', null, ['class'=>'form-control']) !!}
	    </div>

	    <div class='form-group'>
	        {!! Form::label('category', 'Category : ') !!}
	        {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
	    </div>

	    <div class='form-group'>
	        {!! Form::label('photo_id', 'Photo File : ') !!}
	        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
	    </div>

	    <div class='form-group'>
	        {!! Form::label('description', 'Description : ') !!}
	        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	    </div>
	    
	    <div class="form-group col-md-6">
	        {!! Form::submit('Update Post', ['class'=>'btn btn-primary']) !!}
	    </div>
	    
	    {!! Form::close() !!}

	    {!! Form::open(['method'=>'delete', 'action'=>['AdminPostsController@destroy', $post->id] ]) !!}

	    <div class="form-group col-md-6">
	        {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
	    </div>

	    {!! Form::close() !!}
    </div>
   
    @include('includes.form_error')



@stop