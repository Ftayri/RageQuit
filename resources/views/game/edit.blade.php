@extends('layouts.template')
@section('content')
<div class="hero common-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1> Edit {{ $game->game_name }}</h1>
					<ul class="breadcumb">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="search-form">
                        @if(!$errors->isEmpty())
                            <div class="row">
                                <div class="col-md-6 alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        @endif
                        <h4 class="sb-title">Edit {{ $game->game_name }}</h4>
                        <form method="post" class="form-style-1" action="{{ route('game.update',['id'=>$game->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div id="container" class="row">
                                <div class="col-md-6 form-it">
                                    <label>Game name</label>
                                     <input name="game_name" type="text" value="{{ $game->game_name }}" required>
                                </div>
                                <div class="col-md-3 form-it">
                                    <label>Game artwork</label>
                                    <input name="photo" type="file">
                                </div>
                                <div class="col-md-3 form-it">
                                    <label>Game background</label>
                                    <input name="background_image" type="file">
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Official Website</label>
                                    <input name="website_link" type="text" value="{{ $game->website_link }}">
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Steam link</label>
                                    <input name="steam_link" type="text" value="{{ $game->steam_link }}">
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Trailer link</label>
                                    <input name="trailer_link" type="text" value="{{ $game->trailer_link }}">
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Genre</label>
                                    <select name="genre_id">
                                        @foreach($genres as $genre)
                                            @if($genre->id == $game->genre_id)
                                                <option value="{{ $genre->id }}" selected>{{ $genre->genre_name }}</option>
                                            @else
                                            <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 form-it">
                                    <label>Description</label>
                                    <textarea name="description">{{ $game->description }}</textarea>
                                </div>
                                @for($i=0;$i<count($currentPublishers);$i++)
                                <div class="col-md-3 form-it">
                                    <label>Publisher</label>
                                    <select name="publisher_id[]">
                                        <option>Select publisher</option>
                                        @foreach($publishers as $publisher)
                                            @if($publisher->id == $currentPublishers[$i])
                                                <option value="{{ $publisher->id }}" selected>{{ $publisher->publisher_name }}</option>
                                            @else
                                                <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-it">
                                    <label>Platform</label>
                                    <select name="platform_id[]">
                                        <option>Select platform</option>
                                        @foreach($platforms as $platform)
                                            @if($platform->id == $currentPlatforms[$i][0])
                                                <option value="{{ $platform->id }}" selected>{{ $platform->platform_name }}</option>
                                            @else
                                                <option value="{{ $platform->id }}">{{ $platform->platform_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-it">
                                    <label>Release Year</label>
                                    <input name="release_year[]" type="text" value="{{ $releaseYears[$i][0] }}" required>
                                </div>
                                <div class="col-md-2 form-it">
                                    <label>Add</label>
                                    <button>+</button>
                                </div>
                                <div class="col-md-1 form-it">
                                    <label>Remove</label>
                                    <button>-</button>
                                </div>
                                @endfor
                                <div class="col-md-12 ">
                                    <input class="submit" type="submit" value="submit">
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection