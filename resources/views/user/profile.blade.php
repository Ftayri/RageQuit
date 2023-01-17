@extends('layouts.template')
@section('content')
<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 style="margin-left:-350px;">{{ Auth::user()->name }}’s profile</h1>
					<ul class="breadcumb">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Favorite Games</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img">
						<a href="#"><img src="images/uploads/user-img.png" alt=""><br></a>
					</div>
					<div class="user-fav">
						<p>Account Details</p>
						<ul>
							<li class="active"><a href="{{ route('user.profile') }}">Favorite games</a></li>
							<li><a href="{{ route('user.profile-edit') }}">Edit profile</a></li>
						</ul>
					</div>
					<div class="user-fav">
						<p>Others</p>
						<ul>
							<li><a href="{{ route('user.logout') }}">Log out</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="topbar-filter user">
                    <p>Found <span>{{ $totalGames }}</span> in total</p>
				</div>
				<div class="flex-wrap-movielist grid-fav">
                    @foreach($userGames as $userGame)
                        @php $game = $userGame->game;@endphp
						<div class="movie-item-style-2 movie-item-style-1 style-3">
							<img src="{{ asset('images/games/'.$game->photo)}}" alt="">
							<div class="hvr-inner">
	            				<a  href="{{ route('game.details',['id'=>$game->id,'page'=>1]) }}"> Read more <i class="ion-android-arrow-dropright"></i> </a>
	            			</div>
							<div class="mv-item-infor">
								<h6><a href="{{ route('game.details',['id'=>$game->id,'page'=>1]) }}">{{ $game->game_name }}</a></h6>
								<p class="rate"><i class="ion-android-star"></i><span>{{ $game->average_rating }}</span> /10</p>
							</div>
						</div>
                    @endforeach			
				</div>		
				<div class="topbar-filter">
                    <div class="pagination2">
                    <span>Page number {{ $page }}:</span>
                    @if($page>1)
                        <a href="{{ route('user.profile',['page' => $page-1]) }}"><i class="ion-arrow-left-b" style="padding-right:14px;"></i></a>
                    @endif
                    <a class="active" href="#">{{ $page }}</a>
                    @if($page*20<$totalGames)
                        <a href="{{ route('user.profile',['page' => $page+1]) }}"><i class="ion-arrow-right-b"></i></a>
                    @endif
                </div>
			</div>
		</div>
	</div>
</div>
@endsection