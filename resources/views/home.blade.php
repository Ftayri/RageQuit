@extends('layouts.template')
@section('content')
<div class="slider movie-items">
	<div class="container">
		<div class="row">
			<div class="social-link">
				<p>Follow us: </p>
				<a href="#"><i class="ion-social-facebook"></i></a>
				<a href="#"><i class="ion-social-twitter"></i></a>
				<a href="#"><i class="ion-social-googleplus"></i></a>
				<a href="#"><i class="ion-social-youtube"></i></a>
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
                            <h6><a href="{{route('game.details',$game->id)}}">{{ $game->game_name }}</a></h6>
                            <p><i class="ion-android-star"></i><span>7.4</span> /10</p>
                        </div>
                    </div>
                @endforeach
            </div>
	    </div>
	</div>
</div>
@endsection