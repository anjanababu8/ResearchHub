<?php $__env->startSection('content'); ?>
	<?php if(Session::has('message')): ?>
		<div class="alert alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <?php echo e(Session::get('message')); ?>

		</div>
	<?php endif; ?>

	<?php if(isset($data)): ?>
	    <div class="media">
	      <a class="pull-left" href="#">
	        <img class="media-object" src="<?php echo e($data->pictureUrl); ?>" alt="Profile image">
	      </a>
	      <div class="media-body">
	        <h4 class="media-heading">Name: </h4>
	        <p><?php echo e($data->firstName .' '.$data->lastName); ?></p>
	        <h4 class="media-heading">Date of Birth: </h4>
	        <p><?php echo e($data->dateOfBirth->day .'/'.$data->dateOfBirth->month.'/'.$data->dateOfBirth->year); ?></p>
	        <h4 class="media-heading">Location: </h4>
	        <p><?php echo e($data->location->country->code .' ,'.$data->location->name); ?></p>
	        <h4 class="media-heading">All captured info: </h4>
	        <pre><?php echo e(var_dump($data)); ?></pre>
	      </div>
	    </div>
	<?php else: ?>
		
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>