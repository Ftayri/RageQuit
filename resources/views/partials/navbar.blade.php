<!-- BEGIN | Header -->
<header class="ht-header">
	<div class="container">
		<nav class="navbar navbar-default navbar-custom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header logo">
                <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <div id="nav-icon1">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <a href="index-2.html"><img class="logo" src="{{ asset('images/logo1.png') }}" alt="" width="119" height="58"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav flex-child-menu menu-left">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}"class="btn btn-default">
                        Home <i aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown">
                        Games <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="{{ route('game.index',['page' => 1]) }}">Discover</a></li>
                            <li><a href="homev2.html">Add Game</a></li>
                            <li><a href="{{ route('publisher.create') }}">Add Publisher</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav flex-child-menu menu-right">
                    @if(Auth::check())
                        <li><a href="{{ route('user.profile',['page'=>1]) }}">{{ Auth::user()->name }}</a></li>
                        <li class="btn btn-default"><a href="{{ route('user.logout') }}">Sign out</a></li>
                    @else
                        <li class="loginLink"><a href="#">Sign in</a></li>
                        <li class="btn signupLink"><a id="signup" href="#">Sign up</a></li>
                    @endif
                    
                </ul>
            </div>
        <!-- /.navbar-collapse -->
        </nav>
	    <!-- top search form -->
	    <div class="top-search">
            <form style="width:100%" method="get" action="{{ route('game.search') }}">
			    <input type="text" name="search" placeholder="Search for a game">
            </form>
	    </div>
	</div>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
 @if($errors->signupErrors->any())
    <script type="text/javascript">
    setTimeout(function(){
        $('#signup').click();
    }, 3000);
    </script>
@elseif($errors->loginErrors->any())
    <script type="text/javascript">
    setTimeout(function(){
        $('.loginLink').click();
    }, 3000);
    </script>
@endif
<!-- END | Header -->
