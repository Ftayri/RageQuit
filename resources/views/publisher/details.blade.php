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
							<a href="{{ $publisher->twitter_link }}" class="parent-btn" target="_blank"><i class="ion-social-twitter"></i> Twitter</a>
						@endif
						@if($publisher->website_link)
							<a href="{{ $publisher->website_link }}" class="parent-btn" target="_blank"><i class="ion-android-globe"></i> Website</a>
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
					<div class="movie-tabs">
						<div class="tabs">
							<ul class="tab-links tabs-mv">
								@if($page>1)
									<li><a href="#overview">Overview</a></li>
									<li class="active"><a href="#moviesrelated"> Published Games</a></li>
								@else
									<li class="active"><a href="#overview">Overview</a></li>
									<li ><a href="#moviesrelated"> Published Games</a></li> 
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
						            		<p>{{ $publisher->description }}</p>
						            	</div>
						            	<div class="col-md-4 col-xs-12 col-sm-12">
						            		<div class="sb-it">
						            			<h6>Platforms: </h6>
                                                <p>
                                                    @forelse($platformNames as $platformName)
                                                    <a href="#">{{ $platformName }} </a>,
													@empty
													<p>No platforms found</p>
													@endforelse
                                                </p>
						            		</div>
											<div class="sb-it">
												<p><a href="{{ route('publisher.edit',['id'=>$publisher->id]) }}">Edit Publisher</a></p>
											</div>
						            	</div>
						            </div>
						        </div>
								@if($page>1)
					       	 	<div id="moviesrelated" class="tab active">
								@else
								<div id="moviesrelated" class="tab">
								@endif
					       	 		<div class="row">
					       	 			<h3>Games published by</h3>
					       	 			<h2>{{ $publisher->publisher_name }}</h2>
											<div class="topbar-filter">
												<p>Found <span>{{ $totalGames }}</span> in total</p>
											</div>
											@if($totalGames!=0)
											@foreach($games as $game)
												@include('partials.games_index')
											@endforeach
											<div class="topbar-filter">
												<div class="pagination2">
													<span>Page number {{ $page }}:</span>
													@if($page>1)
														<a href="{{ route('publisher.details',['id'=>$publisher->id, 'page' => $page-1]) }}"><i class="ion-arrow-left-b" style="padding-right:14px;"></i></a>
													@endif
													<a class="active" href="#">{{ $page }}</a>
													<a href="{{ route('publisher.details',['id'=>$publisher->id, 'page' => $page+1]) }}"><i class="ion-arrow-right-b"></i></a>
												</div>
											</div>
										@endif
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