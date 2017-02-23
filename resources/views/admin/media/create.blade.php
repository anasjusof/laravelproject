@extends('layouts.admin')

@section('styles')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">



@stop


@section('content')
    <div class="col-md-12">

    	<h1 class="text-center">Upload Media</h1>

    </div>

    <div class="col-md-12">
    	{!! Form::open(['method'=>'POST', 'action'=>'AdminMediaController@store', 'files'=>true, 'class'=>'dropzone']) !!}

    	{!! Form::close() !!}

    </div>

@stop

@section('scripts')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

@stop