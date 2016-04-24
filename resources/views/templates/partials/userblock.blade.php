<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" alt="" src="{{ $user->profilephoto == null?URL::to('/').'/img/default_profile_photo.jpg':$user->profilephoto }}" style="height:120px;width:120px">
	</a>
	<div class="media-body">
		<h2 class="media-heading"><a href="{{ route('profile.index', ['id' => $user->id]) }}">{{ $user->fullname() }}</a></h2>	
		<h4>{{$user->college}}</h4>
		<p>{{$user->department}}</p>
	</div>
</div>