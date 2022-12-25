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
						@if(!empty($genre))
							<li> <span class="ion-ios-arrow-right"></span>{{ $genre->genre_name }} games</li>
						@elseif(!empty($platform))
							<li> <span class="ion-ios-arrow-right"></span>{{ $platform->platform_name }} games</li>
						@else
							<li> <span class="ion-ios-arrow-right"></span>game listing</li>
						@endif
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
                    @include('partials.games_index')
                @endforeach
				<div class="topbar-filter">
					<div class="pagination2">
						<span>Page number {{ $page }}:</span>
						@if($page>1)
							@if(!empty($genre))
								<a href="{{ route('genre.games',['id'=>$genre->id,'page'=>$page-1]) }}"><i class="ion-arrow-left-b"></i></a>
							@elseif(!empty($platform))
								<a href="{{ route('platform.games',['id'=>$platform->id,'page'=>$page-1]) }}"><i class="ion-arrow-left-b"></i></a>
							@else
								<a href="{{ route('game.index',['page'=>$page-1]) }}"><i class="ion-arrow-left-b"></i></a>
							@endif
						@endif
						<a class="active" href="#">{{ $page }}</a>
						@if(!empty($genre))
							<a href="{{ route('genre.games',['id'=>$genre->id,'page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
						@elseif(!empty($platform))
							<a href="{{ route('platform.games',['id'=>$platform->id,'page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
						@else
							<a href="{{ route('game.index',['page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
						@endif
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
				</div>
			</div>
		</div>
	</div>
</div>
@endsection