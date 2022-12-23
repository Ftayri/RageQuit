@extends('layouts.template')
@section('content')
<div class="hero common-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1> game listing - list</h1>
					<ul class="breadcumb">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span> game listing</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single movie_list">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="topbar-filter">
					<p>Found <span>{{ $totalGames }} games</span> in total</p>
					<label>Sort by:</label>
					<select>
						<option value="popularity">Popularity Descending</option>
						<option value="popularity">Popularity Ascending</option>
						<option value="rating">Rating Descending</option>
						<option value="rating">Rating Ascending</option>
						<option value="date">Release date Descending</option>
						<option value="date">Release date Ascending</option>
					</select>
					<a href="movielist.html" class="list"><i class="ion-ios-list-outline active"></i></a>
					<a  href="moviegrid.html" class="grid"><i class="ion-grid"></i></a>
				</div>
                @foreach($games as $game)
					@php
						//initialize variables
						$gamePlatforms=array();
						$gamePublishers=array();
						$platformnames=array();
						$releaseYear=10000;
						$gamePublishers=$game->gamePublishers;
						foreach($gamePublishers as $gamePublisher){
							$gamePlatforms[]=$gamePublisher->gamePlatforms;
						}
						foreach($gamePlatforms as $platforms){
							foreach($platforms as $platform){
								echo $game->game_name." ".$platform->release_year."<br>";
								if($platform->release_year<=$releaseYear){
									$releaseYear=$platform->release_year;
								}
							}
						}
						foreach($gamePlatforms as $platforms){
							foreach($platforms as $platform){
								$platformnames[]=$platform->platform->platform_name;
							}
						}
						$platformnames=array_unique($platformnames);
					@endphp
                    <div class="movie-item-style-2">
                        <img src="{{ asset('images/games/'.$game->photo) }}" alt="">
                        <div class="mv-item-infor">
                            <h6><a href="{{ route('game.details',$game->id) }}">{{ $game->game_name }} <span>({{ $releaseYear }})</span></a></h6>
                            <p class="rate"><i class="ion-android-star"></i><span>{{ $game->average_rating }}</span> /10</p>
                            <p class="describe">{{ Str::limit($game->description,300 ) }}</p>
                            <p>Platforms:
                                @foreach($platformnames as $platformname)
                                    <span>{{ $platformname }}, </span>
								@endforeach
                            </p>
                            <p>Genre: <span>{{ $game->genre->genre_name }}</span></p>
                            <p><span>Release: {{ $releaseYear }}</span></p>
                        </div>
                    </div>
                @endforeach
				<div class="topbar-filter">
					<div class="pagination2">
						<span>Page number {{ $page }}:</span>
                        @if($page>1)
                            <a href="{{ route('game.index',['page'=>$page-1]) }}"><i class="ion-arrow-left-b"></i></a>
                        @endif
						<a class="active" href="#">{{ $page }}</a>
						<a href="{{ route('game.index',['page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="sidebar">
					<div class="searh-form">
						<h4 class="sb-title">Search for movie</h4>
						<form class="form-style-1" action="#">
							<div class="row">
								<div class="col-md-12 form-it">
									<label>Movie name</label>
									<input type="text" placeholder="Enter keywords">
								</div>
								<div class="col-md-12 form-it">
									<label>Genres & Subgenres</label>
									<div class="group-ip">
										<select
											name="skills" multiple="" class="ui fluid dropdown">
											<option value="">Enter to filter genres</option>
											<option value="Action1">Action 1</option>
					                        <option value="Action2">Action 2</option>
					                        <option value="Action3">Action 3</option>
					                        <option value="Action4">Action 4</option>
					                        <option value="Action5">Action 5</option>
										</select>
									</div>
									
								</div>
								<div class="col-md-12 form-it">
									<label>Rating Range</label>
									
									 <select>
										<option value="range">-- Select the rating range below --</option>
										<option value="saab">-- Select the rating range below --</option>
										<option value="saab">-- Select the rating range below --</option>
										<option value="saab">-- Select the rating range below --</option>
									</select>
									
								</div>
								<div class="col-md-12 form-it">
									<label>Release Year</label>
									<div class="row">
										<div class="col-md-6">
											<select>
												<option value="range">From</option>
												<option value="number">10</option>
												<option value="number">20</option>
												<option value="number">30</option>
											</select>
										</div>
										<div class="col-md-6">
											<select>
												<option value="range">To</option>
												<option value="number">20</option>
												<option value="number">30</option>
												<option value="number">40</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-12 ">
									<input class="submit" type="submit" value="submit">
								</div>
							</div>
						</form>
					</div>
					<div class="ads">
						<img src="images/uploads/ads1.png" alt="">
					</div>
					<div class="sb-facebook sb-it">
						<h4 class="sb-title">Find us on Facebook</h4>
						<iframe src="#" data-src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftemplatespoint.net%2F%3Ffref%3Dts&tabs=timeline&width=340&height=315px&small_header=true&adapt_container_width=false&hide_cover=false&show_facepile=true&appId"  height="315" style="width:100%;border:none;overflow:hidden" ></iframe>
					</div>
					<div class="sb-twitter sb-it">
						<h4 class="sb-title">Tweet to us</h4>
						<div class="slick-tw">
							<div class="tweet item" id=""><!-- Put your twiter id here -->
							</div>
							<div class="tweet item" id=""><!-- Put your 2nd twiter account id here -->
							</div>
						</div>							
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection