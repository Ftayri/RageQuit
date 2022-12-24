@php
    //initialize variables
    $gamePlatforms=array();
    $gamePublishers=array();
    $platformNames=array();
    $releaseYear=10000;
    $gamePublishers=$game->gamePublishers;
    foreach($gamePublishers as $gamePublisher){
    	$gamePlatforms[]=$gamePublisher->gamePlatforms;
    }
    foreach($gamePlatforms as $platforms){
    	foreach($platforms as $platform){
    		if($platform->release_year<=$releaseYear){
    			$releaseYear=$platform->release_year;
    		}
    	}
    }
    foreach($gamePlatforms as $platforms){
    	foreach($platforms as $platform){
    		$platformNames[]=$platform->platform->platform_name;
    	}
    }
    $platformNames=array_unique($platformNames);
@endphp
<div class="movie-item-style-2">
    <img src="{{ asset('images/games/'.$game->photo) }}" alt="">
    <div class="mv-item-infor">
        <h6><a href="{{ route('game.details',['id'=>$game->id,'page'=>1]) }}">{{ $game->game_name }} <span>({{ $releaseYear }})</span></a></h6>
        <p class="rate"><i class="ion-android-star"></i><span>{{ $game->average_rating }}</span> /10</p>
        <p class="describe">{{ Str::limit($game->description,300 ) }}</p>
        <p>Platforms:
            @foreach($platformNames as $platformName)
                <span>{{ $platformName }}, </span>
            @endforeach
        </p>
        <p>Genre: <span>{{ $game->genre->genre_name }}</span></p>
        <p><span>Release: {{ $releaseYear }}</span></p>
    </div>
</div>