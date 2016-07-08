<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#toggle" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Chatty</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="toggle">
            @if (Auth::check())
                <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="query" placeholder="Find People..">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{ route('profile.index',['username' => Auth::user()->username]) }}">{{ Auth::user()->getNameOrUsername() }}</a></li>
                    <li><a href="{{ route('profile.friend') }}">Friends</a></li>
                    <li><a href="{{ route('profile.edit') }}">Update Profile</a></li>
                    <li><a href="{{ route('auth.signout') }}">Sign Out</a></li>
                @else
                    <li><a href="{{ route('auth.signup') }}">Sign Up</a></li>
                    <li><a href="{{ route('auth.signin') }}">Sign In</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>