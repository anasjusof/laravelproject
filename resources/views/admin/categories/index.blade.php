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
    	{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store', 'files'=>true]) !!}
		    <div class='form-group'>
		        {!! Form::label('name', 'Category Name : ') !!}
		        {!! Form::text('name', null, ['class'=>'form-control']) !!}
		    </div>

		    <div class="form-group">
		        {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
		    </div>

    	{!! Form::close() !!}
    	
    </div>
    <div class="col-sm-6">
    	<table class="table table-bordered">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Name</th>
		        <th>Created</th>
		        <th>Updated</th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>
		      @if($categories)
		      @foreach($categories as $category)
		      <tr>
		        <td>{{$category->id}}</td>
		        <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
		        <td>{{$category->created_at->diffForHumans()}}</td>
		        <td>{{$category->updated_at->diffForHumans()}}</td>
		        <td>
		        	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}

					    <div class="form-group">
					        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
					    </div>

    				{!! Form::close() !!}
		        </td>
		      </tr>
		      @endforeach
		      @endif
		    </tbody>
		</table>
    </div>


@stop