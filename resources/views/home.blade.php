@extends('templates.default')

@section('content')
	<div class="col-md-12" style="position:fixed;top:0;height:100%">
	    <div class="col-md-6" style="height:100%">
	        <div style="position:absolute;top:37%;left:30%;">
	            <h1>ResearchHub</h1>
	            <h3>Connected Research</h3>
	        </div>
	    </div>
	    <div class="col-md-6" style="height:100%">
	        <div style="position:absolute;top:45%;left:20%;">
	            <a class="btn btn-lg btn-info" href="{{ URL::route('auth.login') }}"><i class="icon-linkedin"></i> | Login with LinkedIn</a>
	        </div>
	    </div>
	</div>
@stop