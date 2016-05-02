<nav class="navbar navbar-default" role="navigation" style="z-index:999">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">ResearchHub</a>
        </div>
        <div class="collapse navbar-collapse">
            <!-- <?php if(Auth::check()): ?> -->
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo e(route('home')); ?>">Timeline</a></li>
                    <li><a href="<?php echo e(route('followers.index')); ?>">Followers</a></li>
                </ul>
                <form class="navbar-form navbar-left" role="search" action="<?php echo e(route('search.results')); ?>">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Find people">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            <!-- <?php endif; ?> -->
            <ul class="nav navbar-nav navbar-right">
                <!-- <?php if(Auth::check()): ?> -->
                    <li><a href="<?php echo e(route('profile.index', ['id' => Auth::user()->id])); ?>"><?php echo e(Auth::user()->fullname()); ?></a></li>
                    <li><a href="#">Update profile</a></li>
                    <li><a href="<?php echo e(route('auth.logout')); ?>">Sign out</a></li>
                <!-- <?php endif; ?> -->
            </ul>
        </div>
    </div>
</nav>
