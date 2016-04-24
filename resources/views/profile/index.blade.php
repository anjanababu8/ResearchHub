@extends('templates.default')

@section('content')
		<div class="row">
		    <div class="col-lg-8">
		        @include('templates.partials.userblock')
		    </div>
		    <div class="col-lg-4">
		    	@if(Auth::user()->id != $user->id)
			    	@if (Auth::user()->isafollower($user))
			    		<p>{{$user->fullname()}} follows you.</p>
			    	@endif
			    	@if(Auth::user()->youareafollower($user))
			    		<p>You are a follower</p>
			    		<a href="#" class="btn btn-primary">Unfollow</a>
			    	@else
			    		<a href="{{ route('follower.add', ['id' => $user->id ]) }}" class="btn btn-primary">Follow</a>
			    	@endif 
			    @endif

		       	<h3>{{ $user->fullname() }}'s followers.</h3>

		       	@if( !$followers->count() )
		       		<p>You have no followers yet.</p>
		       	@else
		       		@foreach ($followers as $follow)
		       			@include('templates/partials/userblock_small')
		       		@endforeach
		       	@endif

		       	<hr/>

		       	<h3>People {{ $user->fullname() }} follow.	</h3>

		       	@if( !$following->count() )
		       		<p>{{ $user->fullname() }} has not followed anyone yet.</p>
		       	@else
		       		@foreach ($following as $follow)
		       			@include('templates/partials/userblock_small')
		       		@endforeach
		       	@endif

		    </div>
		</div>
@stop