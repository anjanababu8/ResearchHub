<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" alt="" src="<?php echo e($user->profilephoto == null?URL::to('/').'/img/default_profile_photo.jpg':$user->profilephoto); ?>" style="height:120px;width:120px">
	</a>
	<div class="media-body">
		<h2 class="media-heading"><a href="<?php echo e(route('profile.index', ['id' => $user->id])); ?>"><?php echo e($user->fullname()); ?></a></h2>	
		<h4><?php echo e($user->college); ?></h4>
		<p><?php echo e($user->department); ?></p>
	</div>
</div>