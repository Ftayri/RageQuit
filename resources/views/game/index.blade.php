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
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="topbar-filter">
					<p>Found <span>{{ $totalGames }} games</span> in total</p>
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
							@elseif(!empty($search))
								<a href="{{ route('game.search',['search'=>$search,'page'=>$page-1]) }}"><i class="ion-arrow-left-b"></i></a>
							@else
								<a href="{{ route('game.index',['page'=>$page-1]) }}"><i class="ion-arrow-left-b"></i></a>
							@endif
						@endif
						<a class="active" href="#">{{ $page }}</a>
						@if(!empty($genre))
							@if($page*5<$totalGames)
							<a href="{{ route('genre.games',['id'=>$genre->id,'page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
							@endif
						@elseif(!empty($platform))
							@if(($page*5<$totalGames))
								<a href="{{ route('platform.games',['id'=>$platform->id,'page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
							@endif
						@elseif(!empty($search))
							@if(($page*5<$totalGames))
								<a href="{{ route('game.search',['search'=>$search,'page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
							@endif
						@else
							@if($page*5<$totalGames)
								<a href="{{ route('game.index',['page'=>$page+1]) }}"><i class="ion-arrow-right-b"></i></a>
							@endif
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
