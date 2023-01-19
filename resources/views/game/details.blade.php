@extends('layouts.template')
<div class="login-wrapper" id="review-content">
    <div class="login-content" style="height:700px">
        <a href="#" class="close">x</a>
        <h3>Write your review:</h3>
        <form id="review" method="post">
			<div class="row">
				<label for="rating">
					Rating:
					<input type="hidden" name="game_id" value="{{ $game->id }}">
					<input type="number" min="0" max="10" name="rating" id="rating" placeholder="" required/>
				</label>
				@error('rating')
					<div class="alert alert-danger">{{$message}}</div>
				@enderror
			</div>
			<div class="row">
				<label for="review">
					Review:
					<textarea name="review" id="review-text" style="height:300px" required></textarea>
				</label>
			</div>
			<div class="row">
           	 <button type="submit">Submit review</button>
           </div>
        </form>
    </div>
</div>
@section('content')
@if($game->background_image)
<div class="hero mv-single-hero" style="background: url('{{asset('/images/backgrounds/'.$game->background_image)}}') no-repeat; background-size: 100%,100%;">
@else
<div class="hero mv-single-hero">
@endif
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
					<img src="{{ asset('images/games/'.$game->photo) }}" alt="">
					<div class="movie-btn">	
						@if($game->trailer_link)
							<div class="btn-transform transform-vertical red">
								<div><a href="#" class="item item-1 redbtn"> <i class="ion-play"></i> Watch Trailer</a></div>
								<div><a href="{{ $game->trailer_link }}" class="item item-2 redbtn fancybox-media hvr-grow"><i class="ion-play"></i></a></div>
							</div>
						@endif
						@if(Auth::check())
						<div class="btn-transform transform-vertical">
							<div><a href="#" class="item item-1 yellowbtn"> <i class="ion-android-add"></i> Write Review</a></div>
							<div><a href="" id="btnReview" class="item item-2 yellowbtn"><i class="ion-android-add"></i></a></div>
						</div>
						@endif
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
							<a href="{{ $game->steam_link }}" class="parent-btn" target="_blank"><i class="ion-steam"></i> Buy on Steam</a>
						@endif
						@if($game->website_link)
							<a href="{{ $game->website_link }}" class="parent-btn" target="_blank"><i class="ion-android-globe"></i> Website</a>
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
							<p><span id="average_rating">{{ $game->average_rating }}</span> /10<br>
								<span id="total_reviews" class="rv">{{ $totalReviews }} Review(s)</span>
							</p>
						</div>
					</div>
					<div class="movie-tabs">
						<div class="tabs">
							<ul class="tab-links tabs-mv">
								@if($page>1)
									<li><a href="#overview">Overview</a></li>
									<li class="active"><a href="#moviesrelated"> Related Games</a></li>
								@else
									<li class="active"><a href="#overview">Overview</a></li>
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
												<a href="{{ route('game.reviews',['id'=>$game->id,'page'=>1]) }}" id="see-reviews" class="time">See All {{ $totalReviews }} Review(s) <i class="ion-ios-arrow-right"></i></a>
											</div>
											<!-- movie user review -->
											@if($firstReview)
											<div class="mv-user-review-item">
												<h3> Review by <a href="{{ route('user.details',['id'=>$firstReview->user->id]) }}" style="color:#4280bf">{{ $firstReview->user->name}}</a></h3>
												<div class="no-star">
													@for($i=0;$i<$firstReview->rating;$i++)
														<i class="ion-android-star"></i>
													@endfor
													@for($j=$i;$j<10;$j++)
														<i class="ion-android-star last"></i>
													@endfor
												</div>
												
												<p>{{ $firstReview->review }}</p>
											</div>
											@endif
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
			$('#see-reviews').html('See all ' +response['total_reviews']+' Review(s)');
			$('#average_rating').html(response['average_rating']);
			$('#total_reviews').html(response['total_reviews']+' Review(s)');
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
<script type="text/javascript">
	//submitreview
	$('#review').on('submit',function(e){
    e.preventDefault();

    let game_id = $('#game_id').val();
	let review = $('#review-text').val();
	let rating = $('#rating').val();
    
    $.ajax({
      url: "/review-game",
      type:"POST",
      data:{
		"_token": "{{ csrf_token() }}",
        game_id:game_id,
		review:review,
		rating:rating,
      },
      success:function(response){
		if('success' in response){			
			$('#average_rating').html(response['average_rating']);
			$('#total_reviews').html(response['total_reviews']+' Review(s)');
			$('.close').click();
		}
		else if(response['error']=='Game not found'){
			alert('You must add the game to your favorites first!');
			$('.close').click();
		}
      },
      error: function(response) {
        
      },
      });
    });
</script>
@endsection