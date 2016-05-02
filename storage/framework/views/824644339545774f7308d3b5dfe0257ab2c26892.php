<?php $__env->startSection('content'); ?>
	<div class="row">
	    <div class="col-lg-8">
	        <h3>Your followers</h3>

	       	<?php if( !$followers->count() ): ?>
		    	<p>You have no followers yet.</p>
		    <?php else: ?>
		    	<?php foreach($followers as $follow): ?>
		    		<?php echo $__env->make('templates/partials/userblock_small', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		    	<?php endforeach; ?>
		    <?php endif; ?>
	    </div>
	    <div class="col-lg-4">
	        <h4>People who followed you recently</h4>
	        
	        <?php if( !$new_followers->count() ): ?>
		    	<p>You have no new followers</p>
		    <?php else: ?>
		    	<?php foreach($new_followers as $follow): ?>
		    		<?php echo $__env->make('templates/partials/userblock_small_with_close', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		    	<?php endforeach; ?>
		    <?php endif; ?>
	    </div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>