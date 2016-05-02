<?php $__env->startSection('content'); ?>
	<h1>Results</h1>
	<h4>Your search for "<?php echo e(Request::input('query')); ?>"</h4>

	<?php if(!$users->count()): ?>
		<p>No results found!!!</p>
	<?php else: ?>
		<div class="row">
			<div class="col-md-12">
				<?php foreach($users as $user): ?>
					<?php echo $__env->make('templates/partials/userblock', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>