<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" alt="" src="{{ $follow->profilephoto == null?URL::to('/').'/img/default_profile_photo.jpg':$follow->profilephoto }}" style="height:50px;width:50px">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="{{ route('profile.index', ['id' => $follow->id]) }}">{{ $follow->fullname() }}</a></h4>	
		<p>{{ $follow->position }}, {{ $follow->department }}</p>
		<p>{{ $follow->college }}</p>
	</div>
</div>