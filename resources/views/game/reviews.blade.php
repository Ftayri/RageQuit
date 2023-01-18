@extends('layouts.template')
@section('content')
<div class="hero common-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1> Reviews</h1>
					<ul class="breadcumb">
						<li class="active"><a href="{{ route('game.details',['id'=>$game->id]) }}">{{ $game->game_name }}</a></li>
							<li> <span class="ion-ios-arrow-right"></span>Reviews</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single movie_list">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="topbar-filter">
					<p>Found <span>{{ $totalReviews }} reviews</span> in total</p>
				</div>
                @foreach($gameUsers as $gameUser)
                <div class="movie-item-style-2">
                    <div class="mv-item-infor">
                        <h6><a href="{{ route('user.details',['id'=>$gameUser->user->id]) }}">{{ $gameUser->user->name }} <span></span></a></h6>
                        <p class="rate"><i class="ion-android-star"></i><span>{{ $gameUser->rating }}</span> /10</p>
                        <p class="describe">{{ $gameUser->review }}</p>
                    </div>
                </div>
                @endforeach
				<div class="topbar-filter">
					<div class="pagination2">
						<span>Page number {{ $page }}:</span>
						@if($page>1)
							<a href="{{ route('game.reviews',['id'=>$game->id,'page'=>$page-1]) }}"><i class="ion-arrow-left-b"></i></a>
						@endif
						<a class="active" href="#">{{ $page }}</a>
                        @if($page*10<$totalReviews)
						    <a href="{{ route('game.reviews',['id'=>$game->id,'page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
                        @endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 @endsection