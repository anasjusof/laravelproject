@extends('layouts.admin')


@section('content')
    @if(Session::has('deleted_user'))
      <!-- <p style="color:grey;" class="bg-danger text-center">{{session('deleted_user')}}</p> -->
      <script>alert("{{session('deleted_user')}}");</script>
    @endif
    <div class="col-md-12">

    	<h1 class="text-center">Media</h1>

    </div>

    <div class="col-sm-12">
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
		      <?php $count = 1; ?>
		      @if($photos)
		      @foreach($photos as $photo)
		      <tr>
		        <td>{{$count}}</td>
		        <td><img height="80" src="{{$photo->file}}" class="img-reponsive"></td>
		        <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
		        <td>{{$photo->updated_at ? $photo->updated_at->diffForHumans() : 'No date'}}</td>
		        <td>
		        	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}

					    <div class="form-group">
					        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
					    </div>

    				{!! Form::close() !!}
		        </td>
		      </tr>
		      <?php $count++; ?>
		      @endforeach
		      @endif
		    </tbody>
		</table>
    </div>


@stop