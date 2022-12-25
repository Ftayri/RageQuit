@extends('layouts.template')
@section('content')
@if($game->background_image)
<div class="hero mv-single-hero" style="background: url('{{asset('/images/backgrounds/'.$game->background_image)}}')">
@else
<div class="hero mv-single-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
			</div>
		</div>
	</div>
</div>
@endif
<div class="page-single movie-single movie_single">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="movie-img sticky-sb">
					<img src="{{ asset('images/games/'.$game->photo) }}" alt="">
					<div class="movie-btn">	
						<div class="btn-transform transform-vertical red">
							<div><a href="#" class="item item-1 redbtn"> <i class="ion-play"></i> Watch Trailer</a></div>
							<div><a href="{{ $game->trailer_link }}" class="item item-2 redbtn fancybox-media hvr-grow"><i class="ion-play"></i></a></div>
						</div>
						<div class="btn-transform transform-vertical">
							<div><a href="" class="item item-1 yellowbtn"> <i class="ion-android-add"></i> Add to Favourites</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="movie-single-ct main-content">
					<h1 class="bd-hd">{{ $game->game_name }} <span>{{ $releaseYear}} @if(date('Y')-$releaseYear>0)({{ date('Y')-$releaseYear }} Years ago)@endif</span></h1>
					@foreach($gamePublishers as $gamePublisher)
						<h1 class="bd-hd"><a class="underlined" href="{{ route('publisher.details',['id'=>$gamePublisher->publisher_id, 'page' => 1]) }}"><span>{{ $gamePublisher->publisher->publisher_name }}</span></a></h1>
					@endforeach
					<br>
					@php $hasGame=false; @endphp
					@if(Auth::check())
						@if(auth()->user()->gameUsers)
							@foreach(auth()->user()->gameUsers as $gameUser)
								@if($gameUser->game_id == $game->id)
									@php $hasGame=true; @endphp
									@break
								@endif
							@endforeach
						@endif
					@endif
					<div class="social-btn">
						@if($hasGame)
							<i id="favicon" class="ion-heart" hidden></i>
							<i id="unfavicon" class="ion-android-close"></i>
						@else
							<i id="favicon" class="ion-heart"></i>
							<i id="unfavicon" class="ion-android-close" hidden></i>
						@endif
						<form id="fav">
							<input type="hidden" id="game_id" name="game_id" value="{{ $game->id }}">
							@if($hasGame)
								<button type="submit" class="parent-btn" id="favorite" hidden> Add to Favorites</button>
								<button type="submit" class="parent-btn" id="unfavorite"> Remove from Favorites</button>
							@else
								<button type="submit" class="parent-btn" id="favorite"> Add to Favorites</button>
								<button type="submit" class="parent-btn" id="unfavorite" hidden> Remove from Favorites</button>
							@endif
						</form>
						@if($game->steam_link)
							<a href="{{ $game->steam_link }}" class="parent-btn"><i class="ion-steam"></i> Buy on Steam</a>
						@endif
						@if($game->website_link)
							<a href="{{ $game->website_link }}" class="parent-btn"><i class="ion-android-globe"></i> Website</a>
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
								@if($page>1)
									<li><a href="#overview">Overview</a></li>
									<li><a href="#reviews"> Reviews</a></li>
									<li class="active"><a href="#moviesrelated"> Related Games</a></li>
								@else
								<li><a href="#overview">Overview</a></li>
									<li><a href="#reviews"> Reviews</a></li>
									<li><a href="#moviesrelated"> Related Games</a></li>
								@endif                        
							</ul>
						    <div class="tab-content">
								@if($page>1)
						        <div id="overview" class="tab">
								@else
								<div id="overview" class="tab active">
								@endif 
						            <div class="row">
						            	<div class="col-md-8 col-sm-12 col-xs-12">
						            		<p>{{ $game->description }}</p>
						            		<div class="title-hd-sm">
												<h4>Videos & Photos</h4>
											</div>
											<div class="mvsingle-item ov-item">
												<a class="img-lightbox"  data-fancybox-group="gallery" href="{{ asset('images/games/'.$game->photo) }}" ><img src="{{ asset('images/games/'.$game->photo) }}" alt=""></a>
												<a class="img-lightbox"  data-fancybox-group="gallery" href="{{ asset('images/games/'.$game->background_image) }}" ><img src="{{ asset('images/backgrounds/'.$game->background_image) }}" alt=""></a>
											</div>
											<div class="title-hd-sm">
												<h4>User reviews</h4>
												<a href="#" class="time">See All 56 Reviews <i class="ion-ios-arrow-right"></i></a>
											</div>
											<!-- movie user review -->
											<div class="mv-user-review-item">
												<h3>Best Marvel movie in my opinion</h3>
												<div class="no-star">
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star"></i>
													<i class="ion-android-star last"></i>
												</div>
												<p class="time">
													17 December 2016 by <a href="#"> hawaiipierson</a>
												</p>
												<p>This is by far one of my favorite movies from the MCU. The introduction of new Characters both good and bad also makes the movie more exciting. giving the characters more of a back story can also help audiences relate more to different characters better, and it connects a bond between the audience and actors or characters. Having seen the movie three times does not bother me here as it is as thrilling and exciting every time I am watching it. In other words, the movie is by far better than previous movies (and I do love everything Marvel), the plotting is splendid (they really do out do themselves in each film, there are no problems watching it more than once.</p>
											</div>
						            	</div>
						            	<div class="col-md-4 col-xs-12 col-sm-12">
						            		<div class="sb-it">
						            			<h6>Platforms: </h6>
												@foreach($gamePlatforms as $gamePlatform)
													<p>
														@foreach($gamePlatform as $gameplat)
															<a href="{{ route('platform.games',['id'=>$gameplat->platform->id,'page'=>1]) }}">{{ $gameplat->platform->platform_name }}</a>,
														@endforeach
													</p>
												@endforeach
						            		</div>
						            		<div class="sb-it">
						            			<h6>Genre:</h6>
						            			<p><a href="{{ route('genre.games',['id'=>$game->genre->id, 'page' => 1]) }}">{{ $game->genre->genre_name }}</a></p>
						            		</div>
						            		<div class="sb-it">
						            			<h6>Release Date:</h6>
						            			<p>{{ $releaseYear }}</p>
						            		</div>
						            	</div>
						            </div>
						        </div>
						        <div id="reviews" class="tab review">
						           <div class="row">
						            	<div class="rv-hd">
						            		<div class="div">
							            		<h3>Related Movies To</h3>
						       	 				<h2>Skyfall: Quantum of Spectre</h2>
							            	</div>
							            	<a href="#" class="redbtn">Write Review</a>
						            	</div>
						            	<div class="topbar-filter">
											<p>Found <span>56 reviews</span> in total</p>
											<label>Filter by:</label>
											<select>
												<option value="popularity">Popularity Descending</option>
												<option value="popularity">Popularity Ascending</option>
												<option value="rating">Rating Descending</option>
												<option value="rating">Rating Ascending</option>
												<option value="date">Release date Descending</option>
												<option value="date">Release date Ascending</option>
											</select>
										</div>
										<div class="mv-user-review-item">
											<div class="user-infor">
												<img src="images/uploads/userava1.jpg" alt="">
												<div>
													<h3>Best Marvel movie in my opinion</h3>
													<div class="no-star">
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star last"></i>
													</div>
													<p class="time">
														17 December 2016 by <a href="#"> hawaiipierson</a>
													</p>
												</div>
											</div>
											<p>This is by far one of my favorite movies from the MCU. The introduction of new Characters both good and bad also makes the movie more exciting. giving the characters more of a back story can also help audiences relate more to different characters better, and it connects a bond between the audience and actors or characters. Having seen the movie three times does not bother me here as it is as thrilling and exciting every time I am watching it. In other words, the movie is by far better than previous movies (and I do love everything Marvel), the plotting is splendid (they really do out do themselves in each film, there are no problems watching it more than once.</p>
										</div>
										<div class="mv-user-review-item">
											<div class="user-infor">
												<img src="images/uploads/userava2.jpg" alt="">
												<div>
													<h3>Just about as good as the first one!</h3>
													<div class="no-star">
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
													</div>
													<p class="time">
														17 December 2016 by <a href="#"> hawaiipierson</a>
													</p>
												</div>
											</div>
											<p>Avengers Age of Ultron is an excellent sequel and a worthy MCU title! There are a lot of good and one thing that feels off in my opinion. </p>

											<p>THE GOOD:</p>

											<p>First off the action in this movie is amazing, to buildings crumbling, to evil blue eyed robots tearing stuff up, this movie has the action perfectly handled. And with that action comes visuals. The visuals are really good, even though you can see clearly where they are through the movie, but that doesn't detract from the experience. While all the CGI glory is taking place, there are lovable characters that are in the mix. First off the original characters, Iron Man, Captain America, Thor, Hulk, Black Widow, and Hawkeye, are just as brilliant as they are always. And Joss Whedon fixed my main problem in the first Avengers by putting in more Hawkeye and him more fleshed out. Then there is the new Avengers, Quicksilver, Scarletwich, and Vision, they are pretty cool in my opinion. Vision in particular is pretty amazing in all his scenes.</p>

											<p>THE BAD:</p>

											<p>The beginning of the film it's fine until towards the second act and there is when it starts to feel a little rushed. Also I do feel like there are scenes missing but there was talk of an extended version on Blu-Ray so that's cool.</p>
										</div>
										<div class="mv-user-review-item">
											<div class="user-infor">
												<img src="images/uploads/userava3.jpg" alt="">
												<div>
													<h3>One of the most boring exepirences from watching a movie</h3>
													<div class="no-star">
														<i class="ion-android-star"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
													</div>
													<p class="time">
														 26 March 2017 by<a href="#"> christopherfreeman</a>
													</p>
												</div>
											</div>
											<p>I can't right much... it's just so forgettable...Okay, from what I remember, I remember just sitting down on my seat and waiting for the movie to begin. 5 minutes into the movie, boring scene of Tony Stark just talking to his "dead" friends saying it's his fault. 10 minutes in: Boring scene of Ultron and Jarvis having robot space battles(I dunno:/). 15 minutes in: I leave the theatre.2nd attempt at watching it: I fall asleep. What woke me up is the next movie on Netflix when the movie was over.</p>

											<p>Bottemline: It's boring...</p>

											<p>10/10 because I'm a Marvel Fanboy</p>
										</div>
										<div class="mv-user-review-item ">
											<div class="user-infor">
												<img src="images/uploads/userava4.jpg" alt="">
												<div>
													<h3>That spirit of fun</h3>
													<div class="no-star">
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
													</div>
													<p class="time">
														26 March 2017 by <a href="#"> juliawest</a>
													</p>
												</div>
											</div>
											<p>If there were not an audience for Marvel comic heroes than clearly these films would not be made, to answer one other reviewer although I sympathize with him somewhat. The world is indeed an infinitely more complex place than the world of Marvel comics with clearly identifiable heroes and villains. But I get the feeling that from Robert Downey, Jr. on down the organizer and prime mover as Iron Man behind the Avengers these players do love doing these roles because it's a lot of fun. If they didn't show that spirit of fun to the audience than these films would never be made.</p>

											<p>So in that spirit of fun Avengers: Age Of Ultron comes before us and everyone looks like they're having a good time saving the world. A computer program got loose and took form in this dimension named Ultron and James Spader who is completely unrecognizable is running amuck in the earth. No doubt Star Trek fans took notice that this guy's mission is to cleanse the earth much like that old earth probe NOMAD which got its programming mixed up in that classic Star Trek prime story. Wouldst Captain James T. Kirk of the Enterprise had a crew like Downey has at his command.</p>
											<p>My favorite is always Chris Evans because of the whole cast he best gets into the spirit of being a superhero. Of all of them, he's already played two superheroes, Captain America and Johnny Storm the Human Torch. I'll be before he's done Evans will play a couple of more as long as the money's good and he enjoys it.</p>

											<p>Pretend you're a kid again and enjoy, don't take it so seriously.</p>
										</div>
										<div class="mv-user-review-item last">
											<div class="user-infor">
												<img src="images/uploads/userava5.jpg" alt="">
												<div>
													<h3>Impressive Special Effects and Cast</h3>
													<div class="no-star">
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star"></i>
														<i class="ion-android-star last"></i>
														<i class="ion-android-star last"></i>
													</div>
													<p class="time">
														26 March 2017 by <a href="#"> johnnylee</a>
													</p>
												</div>
											</div>
											<p>The Avengers raid a Hydra base in Sokovia commanded by Strucker and they retrieve Loki's scepter. They also discover that Strucker had been conducting experiments with the orphan twins Pietro Maximoff (Aaron Taylor-Johnson), who has super speed, and Wanda Maximoff (Elizabeth Olsen), who can control minds and project energy. Tony Stark (Robert Downey Jr.) discovers an Artificial Intelligence in the scepter and convinces Bruce Banner (Mark Ruffalo) to secretly help him to transfer the A.I. to his Ultron defense system. However, the Ultron understands that is necessary to annihilate mankind to save the planet, attacks the Avengers and flees to Sokovia with the scepter. He builds an armature for self-protection and robots for his army and teams up with the twins. The Avengers go to Clinton Barton's house to recover, but out of the blue, Nick Fury (Samuel L. Jackson) arrives and convinces them to fight against Ultron. Will they succeed? </p>

											<p>"Avengers: Age of Ultron" is an entertaining adventure with impressive special effects and cast. The storyline might be better, since most of the characters do not show any chemistry. However, it is worthwhile watching this film since the amazing special effects are not possible to be described in words. Why Pietro has to die is also not possible to be explained. My vote is eight.</p>
										</div>
										<div class="topbar-filter">
											<label>Reviews per page:</label>
											<select>
												<option value="range">5 Reviews</option>
												<option value="saab">10 Reviews</option>
											</select>
											<div class="pagination2">
												<span>Page 1 of 6:</span>
												<a class="active" href="#">1</a>
												<a href="#">2</a>
												<a href="#">3</a>
												<a href="#">4</a>
												<a href="#">5</a>
												<a href="#">6</a>
												<a href="#"><i class="ion-arrow-right-b"></i></a>
											</div>
										</div>
						            </div>
						        </div>
								@if($page>1)
					       	 	<div id="moviesrelated" class="tab active">
								@else
								<div id="moviesrelated" class="tab">
								@endif
					       	 		@foreach($similarGames as $similarGame)
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
										<img src="{{ asset('images/games/'.$similarGame->photo) }}" alt="">
										<div class="mv-item-infor">
											<h6><a href="{{ route('game.details',['id'=>$similarGame->id,'page'=>1]) }}">{{ $similarGame->game_name }} <span>({{ $releaseYear }})</span></a></h6>
											<p class="rate"><i class="ion-android-star"></i><span>{{ $similarGame->average_rating }}</span> /10</p>
											<p class="describe">{{ Str::limit($similarGame->description,300 ) }}</p>
											<p>Platforms:
												@foreach($platformNames as $platformName)
													<span>{{ $platformName }}, </span>
												@endforeach
											</p>
											<p>Genre: <span>{{ $similarGame->genre->genre_name }}</span></p>
											<p><span>Release: {{ $releaseYear }}</span></p>
										</div>
									</div>
									@endforeach
									<div class="topbar-filter">
										<div class="pagination2">
										<span>Page number {{ $page }}:</span>
										@if($page>1)
											<a href="{{ route('game.details',['id'=>$game->id, 'page' => $page-1]) }}"><i class="ion-arrow-left-b" style="padding-right:14px;"></i></a>
										@endif
										<a class="active" href="#">{{ $page }}</a>
										<a href="{{ route('game.details',['id'=>$game->id, 'page' => $page+1]) }}"><i class="ion-arrow-right-b"></i></a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
	$('#fav').on('submit',function(e){
    e.preventDefault();

    let id = $('#game_id').val();
    
    $.ajax({
      url: "/submit-game-user",
      type:"POST",
      data:{
		"_token": "{{ csrf_token() }}",
        game_id:id,
      },
      success:function(response){
		if(response['success']=='User not logged in'){
			alert('You must be logged in to add games to your favorites');
			$('.loginLink').click();
		}
		else if(response['success']=='Successfully added game to your list'){
			$('#favorite').hide();
			$('#favicon').hide();
			$('#unfavorite').show();
			$('#unfavicon').show();
		}
		else if(response['success']=='Successfully removed game from your list'){
			$('#favorite').show();
			$('#favicon').show();
			$('#unfavorite').hide();
			$('#unfavicon').hide();
		}
		else{
			alert('Error');
		}
      },
      error: function(response) {
        console.log(response);
      },
      });
    });
</script>
@endsection