<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" alt="" src="<?php echo e($follow->profilephoto == null?URL::to('/').'/img/default_profile_photo.jpg':$follow->profilephoto); ?>" style="height:50px;width:50px">
	</a>
	<div class="media-body">
		<h4 class="media-heading"><a href="<?php echo e(route('profile.index', ['id' => $follow->id])); ?>"><?php echo e($follow->fullname()); ?></a></h4>	
		<p><?php echo e($follow->position); ?>, <?php echo e($follow->department); ?></p>
		<p><?php echo e($follow->college); ?></p>
	</div>
</div>