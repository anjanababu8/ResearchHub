<div class="media">
	<a class="pull-left" href="#">
		<img class="media-object" alt="" src="<?php echo e($follow->profilephoto == null?URL::to('/').'/img/default_profile_photo.jpg':$follow->profilephoto); ?>" style="height:50px;width:50px">
	</a>
	<div class="media-body">
		<a href="<?php echo e(route('follower.acknowledge', ['id' => $follow->id])); ?>">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</a>
		<h4 class="media-heading"><a href="<?php echo e(route('profile.index', ['id' => $follow->id])); ?>"><?php echo e($follow->fullname()); ?></a></h4>	
		London, UK
	</div>
</div>