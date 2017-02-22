@extends('layouts.admin')


@section('content')
<h1> Create Users </h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}
    <div class='form-group'>
        {!! Form::label('title', 'Title : ') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
        {!! Form::label('category', 'Category : ') !!}
        {!! Form::select('category_id', $categories, 0, ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
        {!! Form::label('photo_id', 'Photo File : ') !!}
        {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    </div>

    <div class='form-group'>
        {!! Form::label('description', 'Description : ') !!}
        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}
   
    @include('includes.form_error')



@stop