@extends('layouts.template')
@section('content')
<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 style="margin-left:-350px;">{{ $username }}’s profile</h1>
					<ul class="breadcumb">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Edit Profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img">
						<a href="#"><img src="{{ asset('images/avatars/'.Auth::user()->avatar) }}" alt=""><br></a>
					</div>
					<div class="user-fav">
						<p>Account Details</p>
						<ul>
							<li  class="active"><a href="{{ route('user.profile-edit') }}">Edit Profile</a></li>
							<li><a href="{{ route('user.profile') }}">Favorite games</a></li>
						</ul>
					</div>
					<div class="user-fav">
						<p>Others</p>
						<ul>
							<li><a href="{{ route('user.logout') }}">Log out</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				@if(session()->has('success'))
                <div class="row">
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                </div>
				@endif
				<div class="form-style-1 user-pro" action="#">
					<form method="post" action="{{ route('user.profile-edit') }}" class="user">
                        @csrf
						<h4>01. Profile details</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Username</label>
								<input name="name" type="text" value="{{ $username }}" required>
							</div>
						</div>
						@error('name','profileErrors')
                            <div class="row">
                                <div class="col-md-6 alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="save">
							</div>
						</div>	
					</form>
                    <form method="post" action="{{ route('user.profile-edit') }}" class="user">
                        @csrf
						<h4>02. Change Email</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Email Address</label>
								<input name="email" type="email" value="{{ $email }}" required>
							</div>
						</div>
                        @error('email','emailErrors')
                            <div class="row">
                                <div class="col-md-6 alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="save">
							</div>
						</div>	
					</form>
					<form id="avatar-form" method="post" action="{{ route('user.profile-edit') }}" class="user" enctype="multipart/form-data">
                        @csrf
						<h4>03. Change Avatar</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Upload avatar</label>
								<input style="height:20%" name="avatar" type="file" required>
							</div>
						</div>
                        @error('avatar','avatarErrors')
                            <div class="row">
                                <div class="col-md-6 alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="save">
							</div>
						</div>	
					</form>
					<form method="post" action="{{ route('user.profile-edit') }}" class="password">
                        @csrf
						<h4>04. Change password</h4>
						<div class="row">
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>New Password</label>
								<input name="password" type="password">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Confirm New Password</label>
								<input name="password_confirmation" type="password">
							</div>
						</div>
						@error('password','passwordErrors')
						<div class="row">
							<div class="col-md-6 alert alert-danger" role="alert">
								{{ $message }}
							</div>
						</div>
					@enderror
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="change">
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
@isset($avatar)
<script>

setTimeout(function(){
	const element = document.getElementById('avatar-form');
	const position = element.getBoundingClientRect();
	console.log(position);
	window.scrollTo({
	top: position.top-100,
	behavior: 'smooth',
	});
}, 1000);
</script>
@endisset
@endsection