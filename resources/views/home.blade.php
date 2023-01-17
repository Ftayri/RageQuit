@extends('layouts.template')
@section('content')
<div class="slider movie-items">
	<div class="container">
		<div class="row">
			<div class="social-link">
				<p>Popular right now:</p>
			</div>
            <div class="slick-multiItemSlider">
                @foreach($games as $game)
                    <div class="movie-item">
                        <div class="mv-img">
                            <a href="#"><img src="{{ asset('images/games/'.$game->photo) }}" alt="" width="285" height="437"></a>
                        </div>
                        <div class="title-in">
                            <div class="cate">
                                <span class="blue"><a href="#">{{ $game->genre->genre_name }}</a></span>
                            </div>
                            <h6><a href="{{route('game.details',['id'=>$game->id])}}">{{ $game->game_name }}</a></h6>
                            <p><i class="ion-android-star"></i><span>{{ $game->average_rating }}</span> /10</p>
                        </div>
                    </div>
                @endforeach
            </div>
	    </div>
	</div>
</div>
@endsection