<?php $__env->startSection('content'); ?>
		<div class="row">
		    <div class="col-lg-8">
		        <?php echo $__env->make('templates.partials.userblock', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		    </div>
		    <div class="col-lg-4">
		    	<?php if(Auth::user()->id != $user->id): ?>
			    	<?php if(Auth::user()->isafollower($user)): ?>
			    		<p><?php echo e($user->fullname()); ?> follows you.</p>
			    	<?php endif; ?>
			    	<?php if(Auth::user()->youareafollower($user)): ?>
			    		<p>You are a follower</p>
			    		<a href="#" class="btn btn-primary">Unfollow</a>
			    	<?php else: ?>
			    		<a href="<?php echo e(route('follower.add', ['id' => $user->id ])); ?>" class="btn btn-primary">Follow</a>
			    	<?php endif; ?> 
			    <?php endif; ?>

		       	<h3><?php echo e($user->fullname()); ?>'s followers.</h3>

		       	<?php if( !$followers->count() ): ?>
		       		<p>You have no followers yet.</p>
		       	<?php else: ?>
		       		<?php foreach($followers as $follow): ?>
		       			<?php echo $__env->make('templates/partials/userblock_small', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		       		<?php endforeach; ?>
		       	<?php endif; ?>

		       	<hr/>

		       	<h3>People <?php echo e($user->fullname()); ?> follow.	</h3>

		       	<?php if( !$following->count() ): ?>
		       		<p><?php echo e($user->fullname()); ?> has not followed anyone yet.</p>
		       	<?php else: ?>
		       		<?php foreach($following as $follow): ?>
		       			<?php echo $__env->make('templates/partials/userblock_small', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		       		<?php endforeach; ?>
		       	<?php endif; ?>

		    </div>
		</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>