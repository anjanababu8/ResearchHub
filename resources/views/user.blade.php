@extends('layouts/layout')

@section('content')
	@if(Session::has('message'))
		<div class="alert alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  {{ Session::get('message')}}
		</div>
	@endif

	@if (isset($data))
	    <div class="media">
	      <a class="pull-left" href="#">
	        <img class="media-object" src="{{ $data->pictureUrl }}" alt="Profile image">
	      </a>
	      <div class="media-body">
	        <h4 class="media-heading">Name: </h4>
	        <p>{{$data->firstName .' '.$data->lastName}}</p>
	        <h4 class="media-heading">Date of Birth: </h4>
	        <p>{{$data->dateOfBirth->day .'/'.$data->dateOfBirth->month.'/'.$data->dateOfBirth->year}}</p>
	        <h4 class="media-heading">Location: </h4>
	        <p>{{$data->location->country->code .' ,'.$data->location->name }}</p>
	        <h4 class="media-heading">All captured info: </h4>
	        <pre>{{var_dump($data)}}</pre>
	      </div>
	    </div>
	@else
		
	@endif
@stop