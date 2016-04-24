<nav class="navbar navbar-default" role="navigation" style="z-index:999">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">ResearchHub</a>
        </div>
        <div class="collapse navbar-collapse">
            <!-- @if (Auth::check()) -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Timeline</a></li>
                    <li><a href="{{ route('followers.index') }}">Followers</a></li>
                </ul>
                <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Find people">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            <!-- @endif -->
            <ul class="nav navbar-nav navbar-right">
                <!-- @if (Auth::check()) -->
                    <li><a href="{{ route('profile.index', ['id' => Auth::user()->id]) }}">{{ Auth::user()->fullname() }}</a></li>
                    <li><a href="#">Update profile</a></li>
                    <li><a href="{{ route('auth.logout') }}">Sign out</a></li>
                <!-- @endif -->
            </ul>
        </div>
    </div>
</nav>
