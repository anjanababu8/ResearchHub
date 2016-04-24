@extends('templates.default')

@section('content')
	<div class="row">
	    <div class="col-lg-8">
	        <h3>Your followers</h3>

	       	@if( !$followers->count() )
		    	<p>You have no followers yet.</p>
		    @else
		    	@foreach ($followers as $follow)
		    		@include('templates/partials/userblock_small')
		    	@endforeach
		    @endif
	    </div>
	    <div class="col-lg-4">
	        <h4>People who followed you recently</h4>
	        
	        @if( !$new_followers->count() )
		    	<p>You have no new followers</p>
		    @else
		    	@foreach ($new_followers as $follow)
		    		@include('templates/partials/userblock_small_with_close')
		    	@endforeach
		    @endif
	    </div>
	</div>
@stop