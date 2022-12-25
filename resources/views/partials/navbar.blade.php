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
                    <li>
                        <a href="{{ route('game.index',['page' => 1]) }}" class="btn btn-default">
                        Games <i aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                        celebrities <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="celebritygrid01.html">celebrity grid 01</a></li>
                            <li><a href="celebritygrid02.html">celebrity grid 02 </a></li>
                            <li><a href="celebritylist.html">celebrity list</a></li>
                            <li class="it-last"><a href="celebritysingle.html">celebrity single</a></li>
                        </ul>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                        news <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="bloglist.html">blog List</a></li>
                            <li><a href="bloggrid.html">blog Grid</a></li>
                            <li class="it-last"><a href="blogdetail.html">blog Detail</a></li>
                        </ul>
                    </li>
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                        community <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="userfavoritegrid.html">user favorite grid</a></li>
                            <li><a href="userfavoritelist.html">user favorite list</a></li>
                            <li><a href="userprofile.html">user profile</a></li>
                            <li class="it-last"><a href="userrate.html">user rate</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav flex-child-menu menu-right">
                    <li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                        pages <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="landing.html">Landing</a></li>
                            <li><a href="404.html">404 Page</a></li>
                            <li class="it-last"><a href="comingsoon.html">Coming soon</a></li>
                        </ul>
                    </li>                
                    <li><a href="#">Help</a></li>
                    @if(Auth::check())
                        <li><a href="#">{{ Auth::user()->name }}</a></li>
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
	    	<select>
				<option value="united">TV show</option>
				<option value="saab">Others</option>
			</select>
			<input type="text" placeholder="Search for a movie, TV Show or celebrity that you are looking for">
	    </div>
	</div>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
@if($errors->any())
    @if($errors->has('username_signup') || $errors->has('email') || $errors->has('password_signup') || $errors->has('password_confirmation'))
        <script type="text/javascript">
        //wait a 3 seconds then click on signupLink
        setTimeout(function(){
            $('#signup').click();
        }, 3000);
        </script>
    @else
        <script type="text/javascript">
        //wait a 3 seconds then click on loginLink
        setTimeout(function(){
            $('.loginLink').click();
        }, 3000);
        </script>
    @endif
@endif
<!-- END | Header -->
