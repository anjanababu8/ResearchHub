<?php $__env->startSection('content'); ?>
	<div class="row">
	    <div class="col-lg-12">
	        <div>
		  		<ul class="nav nav-pills" role="tablist">
				    <li role="presentation" class="active"><a href="#status" role="tab" data-toggle="tab">Status</a></li>
				    <li role="presentation"><a href="#event" role="tab" data-toggle="tab">Event</a></li>
				    <li role="presentation"><a href="#upload" role="tab" data-toggle="tab">Upload</a></li>
				</ul>

			  <!-- Tab panes -->
			  	<div class="tab-content">
			    	<div role="tabpanel" class="tab-pane active" id="status">
			    		<br>
			    		<form role="form" action="<?php echo e(route('status.post')); ?>" method="post">
				            <div class="form-group">
				                <textarea placeholder="What's up <?php echo e($user->firstname); ?>?" name="status" class="form-control" rows="2"></textarea>
				            </div>
				            <button type="submit" class="btn btn-default">Update</button>
				            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
				        </form>
			    	</div>
			    	<div role="tabpanel" class="tab-pane" id="event">
			    		<br>
			    		<form role="form" action="<?php echo e(route('event.post')); ?>" method="post">
				            <div class="form-group">
				                <input type="text" placeholder="Create an event?" name="name" class="form-control" required/>
				            </div>
				            <div class="form-group">
				                <input type="time" placeholder="When is it?" name="time" class="form-control" required/>
				            </div>
				            <div class="form-group">
				                <input type="text" placeholder="What time is it?" id="event_date" name="event_date" class="form-control" required/>
				            </div>
				            <div class="form-group">
				                <input type="text" placeholder="Where is it?" name="location" class="form-control" required	/>
				            </div>
				            <div class="form-group">
				                <textarea placeholder="Description" name="date" class="form-control" rows="2"></textarea>
				            </div>
				            <button type="submit" class="btn btn-default">Create</button>
				            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
				        </form>
			    	</div>
			    	<div role="tabpanel" class="tab-pane" id="upload">
			    		<br>
			    		<form role="form" action="<?php echo e(route('publication.post')); ?>" method="post" enctype="multipart/form-data">
				            <div class="form-group">
				                <textarea type="text" placeholder="Say something about this." name="description" class="form-control" row="2"></textarea>
				            </div>
				            <div class="form-group">
				                <input type="text" placeholder="Name" name="name" class="form-control" required/>
				            </div>
				            <div class="form-group">
				                <input type="file" name="file">
				            </div>
				            <button type="submit" class="btn btn-default">Share</button>
				            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
				        </form>
			    	</div>
			  	</div>
		  	</div>
	    </div>
	    <div>

	  <!-- Nav tabs -->
	  	
		  

		</div>
	</div>
	<hr>
	<div class="row">
	    <div class="col-lg-12">
	    	<?php if( !$statuses->count() ): ?>
	    		<p>There is nothing in your timeline, yet.</p>
	    	<?php else: ?>
	    		<?php foreach($statuses as $status): ?>
	    			<?php if( $status->type == 0 ): ?>
				        <div class="media">
						    <a class="pull-left" href="#">
						        <img class="media-object" alt="<?php echo e($status->user->fullname()); ?>" src="<?php echo e($status->user->profilephoto==null?URL::to('/').'/img/default_profile_photo.jpg':$status->user->profilephoto); ?>" style="height:70px; width:70px;">
						    </a>
						   	<div class="media-body">
						        <h4 class="media-heading"><a href=""><?php echo e($status->user->fullname()); ?></a></h4>
						        <p><?php echo e($status->body); ?></p>
						        <ul class="list-inline">
						            <li><?php echo e($status->created_at->diffForHumans()); ?></li>
						            <!--<li><a href="#">Like</a></li>
						            <li>10 likes</li>-->
						        </ul>

						        <!--Uncomment this to include reply to post feature
						        <form role="form" action="#" method="post">
						            <div class="form-group">
						                <textarea name="reply-1" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
						            </div>
						            <input type="submit" value="Reply" class="btn btn-default btn-sm">
						        </form>-->
						    </div>
						</div>
					<?php elseif( $status->type == 1 ): ?>
				        <div class="media">
						    <a class="pull-left" href="#">
						        <img class="media-object" alt="<?php echo e($status->user->fullname()); ?>" src="<?php echo e($status->user->profilephoto==null?URL::to('/').'/img/default_profile_photo.jpg':$status->user->profilephoto); ?>" style="height:70px; width:70px;">
						    </a>
						   	<div class="media-body">
						        <h4 class="media-heading"><a href=""><?php echo e($status->name); ?></a></h4>
						        <p><b>Created by: </b><?php echo e($status->user->fullname()); ?></p>
						        <ul class="list-inline">
						            <li><b>Date: </b><?php echo e($status->date); ?></li>
						            <li><b>Time: </b><?php echo e($status->time); ?></li>
						            <li><b>Venue: </b><?php echo e($status->location); ?></li>
						            <!--<li><a href="#">Like</a></li>
						            <li>10 likes</li>-->
						        </ul>

						        <!--Uncomment this to include reply to post feature
						        <form role="form" action="#" method="post">
						            <div class="form-group">
						                <textarea name="reply-1" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
						            </div>
						            <input type="submit" value="Reply" class="btn btn-default btn-sm">
						        </form>-->
						    </div>
						</div>
					<?php elseif( $status->type == 2 ): ?>
				        <div class="media">
						    <a class="pull-left" href="#">
						        <img class="media-object" alt="<?php echo e($status->user->fullname()); ?>" src="<?php echo e($status->user->profilephoto==null?URL::to('/').'/img/default_profile_photo.jpg':$status->user->profilephoto); ?>" style="height:70px; width:70px;">
						    </a>
						   	<div class="media-body">
						        <!--<h4 class="media-heading"><a href=""><?php echo e($status->name); ?></a></h4>-->
						        <p><b>Created by: </b><?php echo e($status->user->fullname()); ?></p>
						        <a href="<?php echo e(URL::to('/').'/uploads/'.$status->url); ?>"><?php echo e($status->name); ?></a>
						        <!--<ul class="list-inline">
						            <li><b>Date: </b><?php echo e($status->date); ?></li>
						            <li><b>Time: </b><?php echo e($status->time); ?></li>
						            <!--<li><a href="#">Like</a></li>
						            <li>10 likes</li>
						        </ul>

						        <!--Uncomment this to include reply to post feature
						        <form role="form" action="#" method="post">
						            <div class="form-group">
						                <textarea name="reply-1" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
						            </div>
						            <input type="submit" value="Reply" class="btn btn-default btn-sm">
						        </form>-->
						    </div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
	    </div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>