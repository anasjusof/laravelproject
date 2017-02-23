@extends('layouts.admin')


@section('content')
    @if(Session::has('deleted_user'))
      <!-- <p style="color:grey;" class="bg-danger text-center">{{session('deleted_user')}}</p> -->
      <script>alert("{{session('deleted_user')}}");</script>
    @endif
    <div class="col-md-12">

    	<h1 class="text-center">Categories</h1>

    </div>
    
    <div class="col-sm-6">
    	{!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id], 'files'=>true]) !!}
		    <div class='form-group'>
		        {!! Form::label('name', 'Category Name : ') !!}
		        {!! Form::text('name', null, ['class'=>'form-control']) !!}
		    </div>

		    <div class="form-group">
		        {!! Form::submit('Update Category', ['class'=>'btn btn-primary']) !!}
		    </div>

    	{!! Form::close() !!}
    	
    </div>


@stop