@extends('layouts.template')
@section('content')
<div class="hero mv-single-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
			</div>
		</div>
	</div>
</div>
<div class="page-single movie-single movie_single">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="movie-img sticky-sb">
                    @if($publisher->photo)
					    <img src="{{asset('images/publishers/'.$publisher->photo)}}" alt="">
                    @else
                        <img src="{{asset('images/publishers/default.png')}}" alt="">
                    @endif
				</div>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="movie-single-ct main-content">
					<h1 class="bd-hd">{{ $publisher->publisher_name }}</h1>
					<div class="social-btn">
						@if($publisher->website_link)
							<a href="{{ $publisher->twitter_link }}" class="parent-btn"><i class="ion-social-twitter"></i> Twitter</a>
						@endif
						@if($publisher->website_link)
							<a href="{{ $publisher->website_link }}" class="parent-btn"><i class="ion-android-globe"></i> Website</a>
						@endif
						<div class="hover-bnt">
							<a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>Share</a>
							<div class="hvr-item">
								<a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>
								<a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>
								<a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>
								<a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>
							</div>
						</div>
					</div>
					<div class="movie-rate">
						<div class="rate">
							<i class="ion-android-star"></i>
							<p><span>8.1</span> /10<br>
								<span class="rv">56 Reviews</span>
							</p>
						</div>
						<div class="rate-star">
							<p>Rate This Movie:  </p>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star"></i>
							<i class="ion-ios-star-outline"></i>
						</div>
					</div>
					<div class="movie-tabs">
						<div class="tabs">
							<ul class="tab-links tabs-mv">
								<li class="active"><a href="#overview">Overview</a></li>
								<li><a href="#moviesrelated"> Related Games</a></li>                        
							</ul>
						    <div class="tab-content">
						        <div id="overview" class="tab active">
						            <div class="row">
						            	<div class="col-md-8 col-sm-12 col-xs-12">
						            		<p>{{ $publisher->description }}</p>
						            	</div>
						            	<div class="col-md-4 col-xs-12 col-sm-12">
						            		<div class="sb-it">
						            			<h6>Platforms: </h6>
                                                <p>
                                                    @foreach($platformNames as $platformName)
                                                    <a href="#">{{ $platformName }}, </a>
                                                    @endforeach
                                                </p>
						            		</div>
						            		<div class="sb-it">
						            		</div>
						            	</div>
						            </div>
						        </div>
					       	 	<div id="moviesrelated" class="tab">
					       	 		<div class="row">
					       	 			<h3>Related Movies To</h3>
					       	 			<h2>Skyfall: Quantum of Spectre</h2>
					       	 			<div class="topbar-filter">
											<p>Found <span>12 movies</span> in total</p>
											<label>Sort by:</label>
											<select>
												<option value="popularity">Popularity Descending</option>
												<option value="popularity">Popularity Ascending</option>
												<option value="rating">Rating Descending</option>
												<option value="rating">Rating Ascending</option>
												<option value="date">Release date Descending</option>
												<option value="date">Release date Ascending</option>
											</select>
										</div>
										<div class="movie-item-style-2">
											<img src="images/uploads/mv1.jpg" alt="">
											<div class="mv-item-infor">
												<h6><a href="#">oblivion <span>(2012)</span></a></h6>
												<p class="rate"><i class="ion-android-star"></i><span>8.1</span> /10</p>
												<p class="describe">Earth's mightiest heroes must come together and learn to fight as a team if they are to stop the mischievous Loki and his alien army from enslaving humanity...</p>
												<p class="run-time"> Run Time: 2h21’    .     <span>MMPA: PG-13 </span>    .     <span>Release: 1 May 2015</span></p>
												<p>Director: <a href="#">Joss Whedon</a></p>
												<p>Stars: <a href="#">Robert Downey Jr.,</a> <a href="#">Chris Evans,</a> <a href="#">  Chris Hemsworth</a></p>
											</div>
										</div>
										<div class="movie-item-style-2">
											<img src="images/uploads/mv2.jpg" alt="">
											<div class="mv-item-infor">
												<h6><a href="#">into the wild <span>(2014)</span></a></h6>
												<p class="rate"><i class="ion-android-star"></i><span>7.8</span> /10</p>
												<p class="describe">As Steve Rogers struggles to embrace his role in the modern world, he teams up with a fellow Avenger and S.H.I.E.L.D agent, Black Widow, to battle a new threat...</p>
												<p class="run-time"> Run Time: 2h21’    .     <span>MMPA: PG-13 </span>    .     <span>Release: 1 May 2015</span></p>
												<p>Director: <a href="#">Anthony Russo,</a><a href="#">Joe Russo</a></p>
												<p>Stars: <a href="#">Chris Evans,</a> <a href="#">Samuel L. Jackson,</a> <a href="#">  Scarlett Johansson</a></p>
											</div>
										</div>
										<div class="topbar-filter">
											<label>Movies per page:</label>
											<select>
												<option value="range">5 Movies</option>
												<option value="saab">10 Movies</option>
											</select>
											<div class="pagination2">
												<span>Page 1 of 2:</span>
												<a class="active" href="#">1</a>
												<a href="#">2</a>
												<a href="#"><i class="ion-arrow-right-b"></i></a>
											</div>
										</div>
					       	 		</div>
					       	 	</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection