@extends('templates.default')

@section('content')
	<h1>Results</h1>
	<h4>Your search for "{{Request::input('query')}}"</h4>

	@if (!$users->count())
		<p>No results found!!!</p>
	@else
		<div class="row">
			<div class="col-md-12">
				@foreach ($users as $user)
					@include('templates/partials/userblock')
				@endforeach
			</div>
		</div>
	@endif
@stop